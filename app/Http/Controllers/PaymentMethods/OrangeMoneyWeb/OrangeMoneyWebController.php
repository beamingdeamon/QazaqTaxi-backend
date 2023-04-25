<?php

namespace App\Http\Controllers\PaymentMethods\OrangeMoneyWeb;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Models\PaymentOption;
use App\Models\PaymentOptionsConfiguration;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Traits\MerchantTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OrangeMoneyWebController extends Controller
{
    use ApiResponseTrait, MerchantTrait;
    public function getOrangeMoneyConfig($merchant_id){
        $payment_option = PaymentOption::where('slug', 'ORANGEMONEY')->first();
        $paymentOption = PaymentOptionsConfiguration::where([['merchant_id', '=', $merchant_id],['payment_option_id','=',$payment_option->id]])->first();
        $string_file = $this->getStringFile($merchant_id);
        if (empty($paymentOption)) {
            return $this->failedResponse(trans("$string_file.configuration_not_found"));
        }
        return $paymentOption;
    }

    public function OrangeMoneyURL(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'for' => 'required|integer|between:1,2',
            'amount' => 'required',
            'booking_id' => 'nullable|exists:bookings,id'
        ]);
        if ($validator->fails()){
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }

        if($request->for == 1){
            $user = $request->user('api');
            $user_id = $user->id;
            $driver_id = NULL;
            $merchant_id = $user->Merchant->id;
        } else {
            $user = $request->user('api-driver');
            $driver_id = $user->id;
            $user_id = NULL;
            $merchant_id = $user->Merchant->id;
        }

        $paymentOption = $this->getOrangeMoneyConfig($merchant_id);
        $identifier = $paymentOption->api_secret_key;
        $site_id = $paymentOption->api_public_key;
        $client_secret = $paymentOption->auth_token;
        $string_file = $this->getStringFile($merchant_id);

        if(is_null($identifier) || is_null($site_id) || is_null($client_secret)){
            return $this->failedResponse(trans("$string_file.configuration_not_found"));
        }
        $amount = sprintf("%0.2f", $request->amount);
        $order_id = time();

        DB::table('orange_money_transactions')->insert([
            'merchant_id' => $merchant_id,
            'user_id' => $user_id,
            'driver_id' => $driver_id,
            'booking_id' => $request->booking_id,
            'order_id' => $order_id,
            'amount' => $amount,
            'created_at' => Carbon::now(),
        ]);

        $identifier = md5($identifier);
        $site_id = md5($site_id);
        $date = date('c');
        $screen_message = "Test Payment by Orange Money";
        $algo = "sha512";
        $binary_secret = pack("H*", $client_secret);
        $message = "S2M_COMMANDE=$screen_message"."&S2M_DATEH=$date"."&S2M_HTYPE=$algo"."&S2M_IDENTIFIANT=$identifier"."&S2M_REF_COMMANDE=$order_id"."&S2M_SITE=$site_id"."&S2M_TOTAL=$amount";
        $hmac = strtoupper(Hash_hmac(Strtolower($algo), $message, $binary_secret));
        $url = route('api.orange_money_url')."?identifier=".$identifier."&site_id=".$site_id."&amount=".$amount."&order_id=".$order_id."&message=".$screen_message."&date=".encrypt($date)."&algo=".$algo."&hmac=".$hmac;
        return $this->successResponse(trans("$string_file.payment_success"), ['payment_url' => $url]);
    }

    public function OrangeMoney(Request $request)
    {
        $identifier = $request->query('identifier');
        $site_id = $request->query('site_id');
        $amount = $request->query('amount');
        $order_id = $request->query('order_id');
        $message = $request->query('message');
        $date = decrypt($request->query('date'));
        $algo = $request->query('algo');
        $hmac = $request->query('hmac');
        return view('payment/orange/index', compact('identifier', 'site_id', 'amount', 'order_id', 'message', 'date', 'algo', 'hmac'));
    }

    public function OrangeMoneyNotify(Request $request)
    {
        $data = $request->all();
        switch ($request->STATUT) {
            case '117':
                $status = 'Failed';
                break;
            case '200':
                $status = 'Successful';
                break;
            case '220':
                $status = 'Transaction Not Found';
                break;
            case '375':
                $status = 'OTP is expired or already used or invalid';
                break;
        }
        DB::table('orange_money_transactions')->where(['order_id' => $request->REF_CMD])
            ->update([
                'ref_id' => $request->UID,
                'status' => $status,
                'updated_at' => Carbon::now(),
            ]);
        $transaction = DB::table('orange_money_transactions')->where(['order_id' => $request->order_id])->limit(1);
        $user = $transaction->first()->user_id != NULL ? User::find($transaction->first()->user_id) : Driver::find($transaction->first()->driver_id);
        $paymentOption = $this->getOrangeMoneyConfig($user->merchant_id);
        $client_secret = $paymentOption->auth_token;
        $bin_key = pack("H*", $client_secret);
        ksort($data);
        $message = urldecode(http_build_query($data));
        $hmac = strtoupper(hash_hmac(strtolower($data['ALGO']), $message, $bin_key));

        if ($hmac === $_POST['HMAC'] && $request->STATUT == '200'){
            if(isset($transaction->first()->booking_id)){
                $this->OnlinePaymentBookingStatus($transaction->first()->booking_id, 1);
            }
        }
    }

    public function OrangeMoneySuccess(Request $request)
    {
        DB::table('orange_money_transactions')->where(['order_id' => $request->ref_commande])
            ->update([
                'status' => $request->message,
                'updated_at' => Carbon::now(),
            ]);
        $response = trans('api.transaction_completed_successfully');
        return view('payment/orange/callback', compact('response'));
    }

    public function OrangeMoneyFail(Request $request)
    {
        DB::table('orange_money_transactions')->where(['order_id' => $request->ref_commande])
            ->update([
                'status' => $request->message,
                'updated_at' => Carbon::now(),
            ]);
        $response = trans('api.transaction_failed');
        return view('payment/orange/callback', compact('response'));
    }
}
