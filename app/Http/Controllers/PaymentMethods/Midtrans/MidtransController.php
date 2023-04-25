<?php
/**
 * Created by PhpStorm.
 * User: apporio
 * Date: 20/3/23
 * Time: 3:06 PM
 */

namespace App\Http\Controllers\PaymentMethods\Midtrans;


use App\Http\Controllers\Controller;
use App\Models\PaymentOption;
use App\Models\PaymentOptionsConfiguration;
use App\Traits\ApiResponseTrait;
use App\Traits\MerchantTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use DB;

class MidtransController extends Controller
{
    use ApiResponseTrait, MerchantTrait;

    public function __construct()
    {

    }

    public function callback(Request $request, $action){
        \Log::channel('mtrans_api')->emergency(array("action" => $action, "request" => json_encode($request->all())));
        return $this->successResponse("Success");
    }

    public function createTransaction(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'type' => 'required',
                'amount' => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->messages()->all();
                return response()->json(['result' => "0", 'message' => $errors[0], 'data' => []]);
            }
            $user = ($request->type == "USER") ? $request->user('api') : $request->user('api-driver');
            $user_id = $user->id;
            $merchant_id = $user->merchant_id;
            $payment_option = PaymentOption::where('slug', 'MIDTRANS_MOBILE_SDK')->first();
            $paymentOption = PaymentOptionsConfiguration::where([['merchant_id', '=', $merchant_id],['payment_option_id','=',$payment_option->id]])->first();
            if (empty($paymentOption)) {
                return $this->failedResponse(trans('api.message194'));
            }
            $transaction_id = "MIDTRANS-".$merchant_id.Carbon::now()->timestamp;
    
            DB::table('transactions')->insert([
                'status' => $request->type,
                'user_id' => $request->type == "USER" ? $user_id : NULL,
                'driver_id' => $request->type == "USER" ? NULL : $user_id,
                'merchant_id' => $merchant_id,
                'payment_option_id' => $payment_option->payment_option_id,
                'amount' => $request->amount,
                'booking_id' => NULL,
                'order_id' => NULL,
                'handyman_order_id' => NULL,
                'payment_transaction_id' => $transaction_id,
                'request_status' => 1,
                'status_message' => 'PENDING'
            ]);
    
            $data = array(
                'transaction_id' => $transaction_id,
            );
            return $this->successResponse(trans('api.success'), $data);
        }catch(\Exception $e){
            return $this->failedResponse($e->getMessage());
        }
    }
}