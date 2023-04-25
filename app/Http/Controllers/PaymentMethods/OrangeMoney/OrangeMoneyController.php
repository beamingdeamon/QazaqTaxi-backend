<?php

namespace App\Http\Controllers\PaymentMethods\OrangeMoney;

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

class OrangeMoneyController extends Controller
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

    public function getUrl($env){
        return $env == 1 ? "https://api.orange-sonatel.com" : "https://api.sandbox.orange-sonatel.com";
    }

    public function generateOAuthToken($client_id, $client_secret, $base_url){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url.'/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_secret='.$client_secret.'&client_id='.$client_id,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        if (isset($response['access_token'])){
            return $response['access_token'];
        }
        return '';
    }

    public function getPublicKey($token, $base_url){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url.'/api/account/v1/publicKeys',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        if (isset($response['key'])){
            return $response['key'];
        }
        return '';
    }

    public function getNumbers($token,$base_url){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url.'/api/assignments/v1/partner/sim-cards?nbMerchants=1&nbCustomers=1',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function generateSandboxOTP($phone, $pinCode, $publicKey, $token, $base_url){
        openssl_public_encrypt($pinCode, $crypttext, "-----BEGIN PUBLIC KEY-----\r\n".$publicKey."\r\n-----END PUBLIC KEY-----");
        $encryptedPinCode = base64_encode($crypttext);
        $data = [
            'idType' => 'MSISDN',
            'id' => $phone,
            'encryptedPinCode' => $encryptedPinCode
        ];
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url.'/api/eWallet/v1/payments/otp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        if (isset($response['otp'])){
            return $response['otp'];
        }
        return '';
    }

    public function MakeOrangeMoneyPayment(Request $request){
        $validator = Validator::make($request->all(),[
            'type' => 'required',
            'amount' => 'required',
            'currency' => 'required',
        ]);

        if ($validator->fails()){
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }

        $merchant_id = $request->type == 'USER' ? $request->user('api')->merchant_id : $request->user('api-driver')->merchant_id;
        $paymentOption = $this->getOrangeMoneyConfig($merchant_id);
        $base_url = $this->getUrl($paymentOption->gateway_condition);
        $token = $this->generateOAuthToken($paymentOption->api_public_key, $paymentOption->api_secret_key, $base_url);
        if (empty($token)){
            return $this->failedResponse("No OAuth Token Found!!");
        }

        if ($paymentOption->gateway_condition == 1){
            $validator = Validator::make($request->all(),[
                'phone' => 'required',
                'otp' => 'required',
            ]);

            if ($validator->fails()){
                $errors = $validator->messages()->all();
                return $this->failedResponse($errors[0]);
            }
            $phone = $request->phone;
            $otp = $request->otp;
            $merchantCode = $paymentOption->auth_token;
        }else{
            $public_key = $this->getPublicKey($token,$base_url);
            if (empty($public_key)){
                return $this->failedResponse("No Public Key Found!!");
            }
            $numbers = $this->getNumbers($token,$base_url);
            $customer_key = array_search("CUSTOMER",array_column($numbers,'type'));
            $phone = $numbers[$customer_key]['msisdn'];
            $pin = $numbers[$customer_key]['pinCode'];
            $otp = $this->generateSandboxOTP($phone,$pin,$public_key, $token, $base_url);
            if (empty($otp)){
                return $this->failedResponse("OTP Not Found!!");
            }
            $merchant_key = array_search("MERCHANT",array_column($numbers,'type'));
            $merchantCode = $numbers[$merchant_key]['merchantCode'];
        }

        $data = [
            'customer' => [
                'idType' => 'MSISDN',
                'id' => $phone,
                'otp' => $otp,
            ],
            'partner' => [
                'idType' => 'CODE',
                'id' => $merchantCode
            ],
            'amount' => [
                'value' => $request->amount,
                'unit' => $request->currency
            ],
            'reference' => date('YmdHis'),
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url.'/api/eWallet/v1/payments/onestep',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        if ($response['status'] == 'SUCCESS'){
            return $this->successResponse($response['status'], $response);
        }else{
            return $this->failedResponse($response['status'], $response);
        }
    }
}
