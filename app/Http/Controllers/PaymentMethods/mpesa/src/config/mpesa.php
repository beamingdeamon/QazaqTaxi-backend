<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Domain
    |--------------------------------------------------------------------------
    |
    | This is the url where all the endpoints originates from.
    */

    'apiUrl' => 'https://api.safaricom.co.ke/',

    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    |
    | This determines the state of the package, whether to use in sandbox mode or not.
    |
    */

    'is_sandbox' => false,

    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    |
    | These are the credentials to be used to transact with the M-Pesa API
    */
    'apps' => [
        'default' => [
            'consumer_key' => 'fqXmQfB8Kl4TMmbtpYKdLhpbVGOHozg1',

            'consumer_secret' => 'q4mLyHn7ZWKRytSD',
        ],
        'bulk' => [
            'consumer_key' => '',
            'consumer_secret' => '',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | File Cache Location
    |--------------------------------------------------------------------------
    |
    | This will be the location on the disk where the caching will be done.
    |
    */

    'cache_location' => 'cache',


    /*
    |--------------------------------------------------------------------------
    | Callback Method
    |--------------------------------------------------------------------------
    |
    | This is the request method to be used on the Callback URL on communication
    | with your server.
    |
    | e.g. GET | POST
    |
    */

    'callback_method' => 'POST',

    /*
    |--------------------------------------------------------------------------
    | LipaNaMpesa API Online Config
    |--------------------------------------------------------------------------
    |
    | This is a fully qualified endpoint that will be be queried by Safaricom's
    | API on completion or failure of the transaction.
    |
    */
    'lnmo' => [
        /*
        |--------------------------------------------------------------------------
        | Paybill Number
        |--------------------------------------------------------------------------
        |
        | This is a registered Paybill Number that will be used as the Merchant ID
        | on every transaction. This is also the account to be debited.
        |
        |
        |
        */
        'short_code' => 453329,

        /*
        | STK Push callback URL
        |--------------------------------------------------------------------------
        |
        | This is a fully qualified endpoint that will be queried by Safaricom's
        | API on completion or failure of a push transaction.
        |
        */
        'callback' => null,

        /*
        |--------------------------------------------------------------------------
        | SAG Passkey
        |--------------------------------------------------------------------------
        |
        | This is the secret SAG Passkey generated by Safaricom on registration
        | of the Merchant's Paybill Number.
        |
        */
        'passkey' => '15e686de75c7845db12cf42e8e871bc48d799b01357f60a253a23e11a7bab43c',

        /*
        |--------------------------------------------------------------------------
        | Default Transaction Type
        |--------------------------------------------------------------------------
        |
        | This is the Default Transaction Type set on every STK Push request
        |
        */
        'default_transaction_type' => 'CustomerPayBillOnline'

    ],



];
