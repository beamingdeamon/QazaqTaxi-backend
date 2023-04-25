<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PaymentOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_payment_options = [
            ['slug' => 'STRIPE', 'name' => 'Stripe', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Public Key" }'],
            ['slug' => 'PAYTM', 'name' => 'PAYTM', 'params' => '{"api_secret_key": "Merchant ID","api_public_key": "Merchant Key","callback_url": "Call back URL"}'],
            ['slug' => 'KORBA', 'name' => 'Korba', 'params' => '{"api_secret_key": "HMAC SECRET KEY","api_public_key": "HMAC CLIENT KEY","auth_token": "Client Id",callback_url": "Call back URL"}',],
            ['slug' => 'MPESA', 'name' => 'M-Pesa', 'params' => NULL],
            ['slug' => 'CC-AVENUE', 'name' => 'CC-AVENUE', 'params' => NULL,],
            ['slug' => 'RAZORPAY', 'name' => 'RAZORPAY', 'params' => '{"api_secret_key": "Key Id"}'],
            //['slug' => 'SENANGPAY','name' => 'SENANGPAY','params' => '{"api_secret_key": "Secret Key","api_public_key": "Public Key","auth_token": "Authorization token","tokenization_url": "Token generation URL","payment_redirect_url": "Redirection URL","callback_url": "Call back URL"}'],
            ['slug' => 'SENANGPAY', 'name' => 'SENANGPAY', 'params' => '{"auth_token": "Authorization Token","api_secret_key": "Secret Key","tokenization_url": "Token generation URL","payment_redirect_url": "Payment URL","gateway_condition": "Gateway Condition"}'],
            ['slug' => 'MEPS', 'name' => 'MEPS', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Public Key","tokenization_url": "Token generation URL","payment_redirect_url": "Redirection URL","callback_url": "Call back URL" }'],
            ['slug' => 'BANCARD', 'name' => 'BANCARD', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Public Key","tokenization_url": "Token generation URL","payment_redirect_url": "Redirection URL","callback_url": "Call back URL"}'],
            ['slug' => 'PAYSTACK', 'name' => 'PAYSTACK', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Public Key","payment_redirect_url": "Transaction Charge URL"}'],
            ['slug' => 'PEACHPAYMENT', 'name' => 'PEACHPAYMENT', 'params' => '{"api_secret_key": "Entity ID","auth_token": "Authorization token","tokenization_url": "Prepare Checkout URL","payment_redirect_url":"Payment Redirect URL"}'],
            ['slug' => 'PAYPAL', 'name' => 'PAYPAL', 'params' => '{"api_secret_key": "Secret Key","api_client_key": "Client Key","auth_token" : "Currency exchange Key"}'],
            ['slug' => 'SSL COMMERCE', 'name' => 'SSL COMMERCE', 'params' => NULL],
            ['slug' => 'CIELO', 'name' => 'CIELO', 'params' => '{"api_secret_key": "Merchant Key","api_public_key": "Merchant Id","payment_redirect_url": "Transaction Charge URL","tokenization_url": "Tokenization URL"}'],
            ['slug' => 'BRAINTREE', 'name' => 'BRAINTREE', 'params' => '{"api_secret_key": "Private Key","api_public_key": "Public Key","auth_token": "Merchant_id"}'],
            ['slug' => 'IUGU', 'name' => 'IUGU', 'params' => '{"api_secret_key": "Api Secret Key","auth_token": "Account ID" }'],
            ['slug' => 'MERCADO', 'name' => 'MERCADO', 'params' => '{"auth_token": "ACCESS TOKEN"}'],
            ['slug' => 'DPO', 'name' => 'DPO', 'params' => '{"api_secret_key": "Company Token","api_public_key": "Service Types","auth_token": "Company Reference"}'],
            ['slug' => 'BEYONICMOBILE', 'name' => 'BEYONICMOBILE', 'params' => '{"api_secret_key": "API Key","api_public_key": "Account Number"}'],
            ['slug' => 'FLUTTERWAVE', 'name' => 'FLUTTERWAVE', 'params' => '{"api_secret_key": "API Key","api_public_key": "Account Number","auth_token": "Encrypted Key"}'],
            //
            ['slug' => 'PAYU', 'name' => 'PAYU', 'params' => '{"api_secret_key": "Api Login","api_public_key": "Api Key","auth_token"=>"Account ID","payment_step"=>"2"}'], //,""=>"PayU Merchant ID"// payment will be done in 2 steps Authorization, capture

            ['slug' => 'HYPERPAY', 'name' => 'HYPERPAY', 'params' => '{"api_secret_key": "HYPERPAY Entity ID","auth_token": "HYPERPAY Authorization token","tokenization_url": "Prepare Checkout URL","payment_redirect_url":"Payment Redirect URL"}'],
            ['slug' => 'BAYARIND', 'name' => 'BAYARIND', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Merchant ID","tokenization_url": "Prepare Checkout URL"}'],
            ['slug' => 'PAGADITO', 'name' => 'Pagadito', 'params' => '{"api_secret_key": "Pagadito UID","auth_token": "Pagadito    WSK"}'],
            ['slug' => 'MONERIS', 'name' => 'Moneris', 'params' => '{"api_secret_key": "Moneris Store Id","auth_token": "Moneris API Token"}'],
            ['slug' => 'EZYPOD', 'name' => 'EZYPOD', 'params' => '{"api_secret_key": "EZYPOD API Key","api_public_key": "EZYPOD Login Id","payment_redirect_url": "EZYPOD Payment Url"}'],
            ['slug' => 'CONEKTA', 'name' => 'CONEKTA', 'params' => '{"api_secret_key": "CONEKTA API Key","api_public_key": "CONEKTA Login Id","payment_redirect_url": "CONEKTA Payment Url"}'],
            // payment gateway name is ozow by mistaken its written its as ozow
            ['slug' => 'OZOH', 'name' => 'Ozow Instant EFT(Mobile SDK)', 'params' => '{"api_secret_key": "OZOW Private Key","api_public_key": "OZOW Api Key","auth_token":"Merchant Code"}'],
            ['slug' => 'FLUTTERWAVE', 'name' => 'FLUTTERWAVE', 'params' => '{"api_secret_key": "FLUTTERWAVE API Key","api_public_key": "FLUTTERWAVE"}'],
            ['slug' => 'YOPayments', 'name' => 'YO-Uganda', 'params' => '{"api_secret_key": "API Password","api_public_key": "API Username"}'],
            ['slug' => 'MaxiCash', 'name' => 'MaxiCash', 'params' => '{"user_name": "","password": ""}'],
            ['slug' => 'TELR', 'name' => 'TELR', 'params' => '{"api_secret_key": "TELR API Key","api_public_key": "TELR"}'],
            ['slug' => 'IllicoCash', 'name' => 'IllicoCash', 'params' => '{"api_secret_key": "LoginName","api_public_key": "LoginPass","auth_token": "Basic Authorization token","additional_data":"Additional Data Json ({merchantid:?,terminalid:?,encryptkey:?})"}'],
            ['slug' => 'TriPay', 'name' => 'TriPay', 'params' => '{"api_secret_key": "Api Key","api_public_key": "Private Key","auth_token": "Merchant Code","gateway_condition":"Gateway Condition(1-Live, 2-Test)"}'],
            ['slug' => 'BOOKEEY', 'name' => 'BOOKEEY', 'params' => '{"api_secret_key": "BOOKEEY Secret Key","api_public_key": "BOOKEEY Merchant UID"}'],
            ['slug' => 'CinetPay', 'name' => 'CinetPay', 'params' => '{"api_secret_key": "Cinetpay App Key","api_public_key": "Cinetpay Site Key"}'],
            ['slug' => 'PayGate', 'name' => 'PayGate', 'params' => '{"api_secret_key": "Paygate Password","api_public_key": "Paygate ID "}'],
            ['slug' => 'PAYPHONE', 'name' => 'PayPhone', 'params' => '{"api_secret_key": "PayPhone Token","api_public_key": "Customer ID "}'],
            ['slug' => 'AAMARPAY', 'name' => 'aamarPay', 'params' => '{"api_secret_key": "Secret key","api_public_key": "Store ID "}'],
            ['slug' => 'MOMOPAY', 'name' => 'MOMOPay', 'params' => '{"api_public_key": "MOMOPay Api User ID ","api_secret_key": "MOMOPay Api User key","auth_token": "MOMOPay Subscription Key"}'],
            ['slug' => 'EDAHAB', 'name' => 'E-Dahab', 'params' => '{"api_secret_key": "Secret key","api_public_key": "Public Key","auth_token":"Agent Code"}'],
            ['slug' => 'TELEBIRR', 'name' => 'Telebirr', 'params' => '{"api_secret_key": "Secret key","api_public_key": "Public Key"}'],
            ['slug' => 'PAYBOX', 'name' => 'PayBox', 'params' => '{"api_secret_key": "Secret key","api_public_key": "Public Key"}'],
            ['slug' => 'CASHFREE', 'name' => 'CashFree', 'params' => '{"api_secret_key": "Secret key","api_public_key": "App ID "}'],
            ['slug' => 'PROXYPAY', 'name' => 'ProxyPay', 'params' => '{"api_secret_key": "Api Key","api_public_key": "Entity Code"}'],
            ['slug' => 'PAYMAYA', 'name' => 'PayMaya', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Public Key"}'],
            ['slug' => 'PAYHERE', 'name' => 'PayHere', 'params' => '{"api_secret_key": "Merchant Secret","api_public_key": "Merchant Id", "auth_token": "Auth Code(Base64encode(App Id:App Secret))"}'],
            ['slug' => 'SDGEXPRESS', 'name' => 'SDGEXPRESS', 'params' => '{"api_secret_key": "Secret/Password","api_public_key": "Public/User name"}'],
            ['slug' => 'MERCADOCARD', 'name' => 'Mercado Card', 'params' => '{"api_secret_key": "Access Token","api_public_key": "App Key"}'],
            ['slug' => 'MERCADOPIX', 'name' => 'Mercado Bank Transfer', 'params' => '{"api_secret_key": "Access Token","api_public_key": "App Key"}'],
            ['slug' => 'COVERAGEPAY', 'name' => 'Coverage card Payment', 'params' => '{"api_secret_key": " SSL User Pin","api_public_key": "SSL user ID","auth_token": "SSL merchant ID"}'],
            ['slug' => 'ZAAD', 'name' => 'ZAAD ', 'params' => '{"api_secret_key": " Private Key","api_public_key": "Public Key","auth_token": "Auth token"}'],
            ['slug' => 'PAYGATEGLOBAL', 'name' => 'PaygateGlobal ', 'params' => '{"api_secret_key": " Private Key","api_public_key": "Public Key","auth_token": "Auth token"}'],
            ['slug' => 'SQUARE', 'name' => 'Square ', 'params' => '{"api_secret_key": " Private Key"}'],
            ['slug' => 'TOUCHPAY', 'name' => 'Touch Pay ', 'params' => '{"api_secret_key": " Private Key","api_public_key": " Public Key","auth_token": "Auth Token","additional_data": "data in josn format"}'],
            ['slug' => 'CLOVER', 'name' => 'CLOVER ', 'params' => '{"api_secret_key": " Private Token","api_public_key": "Public Token"}'],
            ['slug' => 'KUSHKI', 'name' => 'KUSHKI ', 'params' => '{"api_secret_key": " Private Token","api_public_key": "Public Token"}'],
            ['slug' => 'OPAY', 'name' => 'OPAY ', 'params' => '{"api_secret_key": " Api Secret Key","api_public_key": "Public Key","auth_token": " Merchant ID"}'],
            ['slug' => 'PAYGATEGLOBAL', 'name' => 'PayGateGlobal ', 'params' => '{"api_secret_key": " API Key"}'],
            ['slug' => 'PINPAYMENT', 'name' => 'Pin Payments', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Publishable Key"}'],
            ['slug' => 'PAGUELO_FACIL', 'name' => 'Paguelo Facil', 'params' => '{"api_secret_key": "CCLW Token","api_public_key": "Authorization Token"}'],
            ['slug' => 'PAGOPLUX', 'name' => 'Pagoplux (Mobile Gateway)', 'params' => ''],
            ['slug' => 'WEBXPAY', 'name' => 'Webxpay', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Public Key"}'],
            ['slug' => 'INTERSWITCH', 'name' => 'Interswitch', 'params' => '{"api_secret_key": "Password","api_public_key": "Username", "auth_token": "ClientID:SecretKey"}'],
            ['slug' => 'TELEBIRRPAY', 'name' => 'Telebirr Pay', 'params' => '{"api_secret_key": "Telebirr App Key","api_public_key": "Telebirr App ID","auth_token": "Telebirr Public Key","tokenization_url": "Telebirr ShortCode","payment_redirect_url":"H5 URL"}'],
            ['slug' => 'ORANGEMONEY', 'name' => 'ORANGEMONEY', 'params' => '{"api_secret_key": "ORANGEMONEY Identifier Key", "api_public_key": "ORANGEMONEY Site Id", "auth_token": "ORANGEMONEY Client Secret Key"}'],
            ['slug' => 'IHELA', 'name' => 'iHela', 'params' => '{"api_public_key": "iHela ClientId","api_secret_key": "iHela Client Secret"}'],
            ['slug' => 'BILLBOX', 'name' => 'BillBox', 'params' => '{"api_public_key": "BillBox App Reference","api_secret_key": "BillBox Secret","auth_token": "BillBox AppId"}'],
            ['slug' => 'SAMPAY', 'name' => 'Sampay', 'params' => '{"api_public_key": "Api Key","auth_token": "Auth Key"}'],
            ['slug' => 'PAYGO', 'name' => 'PayGo', 'params' => '{"api_public_key": "User Name","api_secret_key": "Password","auth_token":"Client ID"}'],
            ['slug' => 'KPAY', 'name' => 'KPay', 'params' => '{"api_public_key": "User Name","api_secret_key": "Password","auth_token":"Retailer ID"}'],
            ['slug' => 'POWERTRANZ','name' => 'POWERTRANZ','params' => '{"api_secret_key": "Password","api_public_key": "Username"}'],
            ['slug' => 'EVMAK','name' => 'EvMak','params' => '{"api_public_key": "Project Name","api_secret_key": "EvMak Username"}'],
            ['slug' => 'MIPS','name' => 'MIPS','params' => '{"api_public_key": "Username","api_secret_key": "Password","additional_data":"Additional Data Json ({id_merchant:?,id_entity:?,operator_id:?,remote_user_password:?,cipher_key:?,salt:?})"}'],
            ['slug' => 'GLOMO_MONEY', 'name' => 'Glomo Money', 'params' => '{}'],
            ['slug' => 'PAYSTACK_WEBVIEW', 'name' => 'PAYSTACK Webview', 'params' => '{"api_secret_key": "Secret Key","api_public_key": "Public Key","payment_redirect_url": "Transaction Charge URL"}'],
            ['slug' => 'EBANKILY', 'name' => 'EBankily', 'params' => '{"api_secret_key": "Password","api_public_key": "Username","auth_token": "Client ID"}'],
            ['slug' => 'SAHAY','name' => 'Sahay','params' => '{"api_public_key": "Consumer Key","api_secret_key": "Consumer Secret"}'],
        ];

        foreach ($arr_payment_options as $key => $value) {
            DB::table('payment_options')->insert([
                'slug' => $value['slug'],
                'name' => $value['name'],
                'params' => $value['params'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
