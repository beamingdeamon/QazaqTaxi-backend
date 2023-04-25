<?php

namespace App\Http\Middleware;

use App;
use Closure;
use App\Models\Merchant;

class ApiS3Middleware
{
    public function handle($request, Closure $next)
    {
        $public_key = $request->header('publicKey');
        $secret_key = $request->header('secretKey');
        $AccessToken = $request->header('Authorization');
        if (!empty($public_key) && !empty($secret_key)) {
            $clientDetail = Merchant::where([['merchantPublicKey', '=', $public_key], ['merchantSecretKey', '=', $secret_key], ['merchantStatus', '=', 1]])->first();
        } elseif (!empty($AccessToken) && !empty($request->user('api')->id)) {
            $user = $request->user('api');
            $clientDetail =  $user->Merchant;
        } elseif (!empty($AccessToken) && !empty($request->user('api-driver')->id)) {
            $user = $request->user('api-driver');
            $clientDetail =  $user->Merchant;
        }
        /**
         * Setting File system configuration for dynamic bucket
         */
        if (!empty($clientDetail->id)) {
            setS3Config($clientDetail);
        }

        return $next($request);
    }
}
