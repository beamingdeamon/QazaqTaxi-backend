<?php

namespace App\Http\Controllers\PaymentMethods\Wave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaveController extends Controller
{
    public function generateWaveUrl($request, $payment_option_config, $calling_from){
        DB::beginTransaction();
        try{
            if($calling_from == "USER"){
                $user = $request->user('api');
                $id = $user->id;
                $merchant_id = $user->merchant_id;
                $currency = $user->Country->isoCode;
            }else{
                $driver = $request->user('api-driver');
                $id = $driver->id;
                $merchant_id = $driver->merchant_id;
                $currency = $driver->Country->isoCode;
            }

            $data=[
                'amount' => $request->amount,
                'currency' => $request->currency,
                'error_url' => route('wave.fail'),
                'success_url' => route('wave.success'),
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.wave.com/v1/checkout/sessions',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$payment_option_config->api_secret_key,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response,true);
            if(!empty($response['id'])){
                DB::table('transactions')->insert([
                    'user_id' => $calling_from == "USER" ? $id : NULL,
                    'driver_id' => $calling_from == "DRIVER" ? $id : NULL,
                    'merchant_id' => $merchant_id,
                    'payment_option_id' => $payment_option_config->payment_option_id,
                    'checkout_id' => NULL,
                    'amount' => $currency.' '.$request->amount,
                    'booking_id' => $request->booking_id,
                    'order_id' => $request->order_id,
                    'handyman_order_id' => $request->handyman_order_id,
                    'payment_transaction_id' => $response['id'],
                    'payment_transaction' => NULL,
                    'request_status' => 1,
                ]);
            }
        }catch(\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
        DB::commit();

        return [
            'status' => 'NEED_TO_OPEN_WEBVIEW',
            'url' => $response['wave_launch_url'] ?? '',
            'success_url' => route('wave.success'),
            'fail_url' => route('wave.fail'),
            'transaction_id' => $response['id']
        ];
    }

    public function WaveNotify(Request $request){
        \Log::channel('wave_webhook')->emergency($request->all());
        $data = $request->all();
        if(!empty($data) && $data['type'] == 'checkout.session.completed' && $data['data']['payment_status'] == 'succeeded'){
            $trans = DB::table('transactions')->where(['payment_transaction_id' => $data['data']['id']])->first();
            if (!empty($trans)){
            }
            DB::table('transactions')
                ->where(['payment_transaction_id' => $data['data']['id']])
                ->update(['request_status' => 2, 'payment_transaction' => json_encode($request->all())]);
        }else{
            DB::table('transactions')
                ->where(['payment_transaction_id' => $data['data']['id']])
                ->update(['request_status' => 3, 'payment_transaction' => json_encode($request->all())]);
        }
    }

    public function paymentStatus($request){
        $tx_reference = $request->transaction_id; // order id
        $transaction_table =  DB::table("transactions")->where('payment_transaction_id', $tx_reference)->first();
        $payment_status =   $transaction_table->request_status == 2 ?  true : false;
        if($transaction_table->request_status == 1)
        {
            $request_status_text = "processing";
        }
        else if($transaction_table->request_status == 2)
        {
            $request_status_text = "success";
        }
        else
        {
            $request_status_text = "failed";
        }
        return ['payment_status' => $payment_status, 'request_status' => $request_status_text];
    }

    public function WaveSuccess(){
        echo "<h3 style='text-align: center'>Success!</h3>";
        return true;
    }

    public function WaveFailed(){
        echo "<h3 style='text-align: center'>Failed!</h3>";
        return true;
//        return view('payment/telebirr_pay/callback', compact('response'));
    }
}
