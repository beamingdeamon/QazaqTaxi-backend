<?php

namespace App\Http\Controllers\PaymentMethods\PayPay;
use App\Http\Controllers\Controller;
use App\Models\UserCard;
use hisorange\BrowserDetect\Exceptions\Exception;
use Illuminate\Http\Request;
use DB;
use App\Traits\ApiResponseTrait;
use App\Traits\MerchantTrait;
use Illuminate\Support\Facades\Validator;
use App\Traits\ContentTrait;
use App\Models\Transaction;
use App\Models\DriverCard;
use App\Models\PaymentOptionsConfiguration;
use PayPay\OpenPaymentAPI\Client;
use PayPay\OpenPaymentAPI\Models\CreateQrCodePayload;
use PayPay\OpenPaymentAPI\Models\OrderItem;
use PayPay\OpenPaymentAPI\Models\CapturePaymentAuthPayload;


class PaypayController extends Controller
{
    use ApiResponseTrait, MerchantTrait, ContentTrait;

    public function __construct()
    {
    }


    // DPO Think Payment


//    Card payment by webview

    public function paymentRequest($request,$payment_option_config,$calling_from){

        try {
            

            // check whether request is from driver or user
            if($calling_from == "DRIVER")
            {
                $driver = $request->user('api-driver');
                $code = $driver->Country->phonecode;
                $country_code = $driver->Country->country_code;
                $country = $driver->Country;
                $country_name = $country->CountryName;
                $currency = $driver->Country->isoCode;
                $phone_number = $driver->phoneNumber;
                $logged_user = $driver;
                $user_merchant_id = $driver->driver_merchant_id;
                $first_name = $driver->first_name;
                $last_name = $driver->last_name;
                $email = $driver->email;
                $id = $driver->id;
                $merchant_id = $driver->merchant_id;
                $description = "driver wallet topup";
            }
            else
            {
                $user = $request->user('api');
                $code = $user->Country->phonecode;
                $country = $user->Country;
                $country_name = $country->CountryName;
                $currency = $user->Country->isoCode;
                $phone_number = $user->UserPhone;
                $logged_user = $user;
                $user_merchant_id = $user->user_merchant_id;
                $first_name = $user->first_name;
                $last_name = $user->last_name;
                $email = $user->email;
                $id = $user->id;
                $merchant_id = $user->merchant_id;
                $description = "payment from user";
                $country_code = $user->Country->country_code;
            }

            $amount = $request->amount;
            $order_id = $request->order_id;
            $transaction_id = $id.'_'.time();
            $redirect_url =route("paypay-callback",['TransID'=>$transaction_id]);

            $live = false;
            if($payment_option_config->gateway_condition==1){
                $live = true;
            }

            $client = new Client([
                'API_KEY' => "$payment_option_config->api_public_key",
                'API_SECRET'=>"$payment_option_config->api_secret_key",
                'MERCHANT_ID'=>"$payment_option_config->auth_token",
            ],$live); /* production_mode : Set the connection destination of the sandbox environment / production environment.
 The default false setting connects to the sandbox environment. The True setting connects to the production environment. */

            // setup payment object
            $CQCPayload = new CreateQrCodePayload();

            // Set merchant pay identifier
            $CQCPayload->setMerchantPaymentId($transaction_id);

            // Log time of request
            $CQCPayload->setRequestedAt();
            // Indicate you want QR Code
            $CQCPayload->setCodeType("ORDER_QR");

            // Provide order details for invoicing
            $OrderItems = [];
//            $OrderItems[] = (new OrderItem())
//                ->setName('Cake')
//                ->setQuantity(1)
//                ->setUnitPrice(['amount' => 20, 'currency' => 'JPY']);
            $CQCPayload->setOrderItems($OrderItems);

            // Save Cart totals
            $amount_data = [
                "amount" => $amount,
                "currency" => $currency
            ];
            $CQCPayload->setAmount($amount_data);

            // Configure redirects
            $CQCPayload->setRedirectType('WEB_LINK');
            $CQCPayload->setRedirectUrl($redirect_url);

            // Get data for QR code
            $response = $client->code->createQRCode($CQCPayload);

            $data = $response['data'];

            if (isset($data['url'])) {

                $payment_transaction = [
                    'type'=>'payment request',
                    'data'=>$data
                ];
                \Log::channel('paypay_payment_api')->emergency($payment_transaction);

                $tx_reference =  $transaction_id;

                // enter data
                DB::table('transactions')->insert([
                    'status' => 1, // for user
                    'card_id' => NULL,
                    'user_id' => $calling_from == "USER" ? $id : NULL,
                    'driver_id' => $calling_from == "DRIVER" ? $id : NULL,
                    'merchant_id' => $merchant_id,
                    'payment_option_id' => $payment_option_config->payment_option_id,
                    'checkout_id' => NULL,
                    'payment_transaction_id' => $transaction_id,
                    'payment_transaction' => json_encode($payment_transaction),
                    'reference_id' => $tx_reference, // payment reference id
                    'amount' => $amount, // amount
                    'request_status' => 1,
                    'status_message' => "pending",
                ]);

                $web_view_url = $data['url'];
                return [
                    'status'=>'NEED_TO_OPEN_WEBVIEW',
                    'url'=>$web_view_url,
                    'redirect_url'=>$redirect_url,
                    'trabsaction_id' => $transaction_id
                ];

            }
//            else {
//                throw new Exception(isset($xml['ResultExplanation']) ? $xml['ResultExplanation'] : "Payment Request Failed, something went wrong");
//            }

        }catch(\Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    public function PaymentCallBack(Request $request)
    {

         try
         {
            $request_response = $request->all();
            // p($request_response);
            $data = [
                'type'=>'callback notification',
                'data'=>$request_response
            ];
            \Log::channel('paypay_payment_api')->emergency($data);
    //        p($request_response);

             $tx_reference = $request_response['TransID']; // order id
             $arr_data = DB::table("transactions")->where('reference_id', $tx_reference)->first();
             // p($arr_data);
             $payment_option = PaymentOptionsConfiguration::where([['merchant_id','=',$arr_data->merchant_id],['payment_option_id','=',$arr_data->payment_option_id]])->first();

            $live = false;
            if($payment_option->gateway_condition==1){
                $live = true;
            }

            $client = new Client([
                'API_KEY' => "$payment_option->api_public_key",
                'API_SECRET'=>"$payment_option->api_secret_key",
                'MERCHANT_ID'=>"$payment_option->auth_token"
            ],$live); /* production_mode : Set the connection destination of the sandbox environment / production environment.
 The default false setting connects to the sandbox environment. The True setting connects to the production environment. */

             //get Payment details
            $response =  $client->code->getPaymentDetails($tx_reference);
            $data = $response['data'];

            if($data['status']=='COMPLETED'){
                $transaction = Transaction::where('reference_id', $tx_reference)->first();
                $transaction->request_status  = 2;
                $transaction->status_message  = "Successful payment";
                $transaction->save();
            }


        }catch(\Exception $e)
        {

    //        p($e->getLine(),0);
            return $e->getMessage();
            //p($e->getTrace());
        }

    }


    public function paymentStatus(Request $request)
    {
        $tx_reference = $request->transaction_id; // order id
        $transaction_table =  DB::table("transactions")->where('reference_id',$tx_reference)->first();

        // check payment status
        $payment_status =   $transaction_table->request_status == 2 ?  true : false;
        return $return = [
            'payment_status' =>$payment_status ];
    }

}