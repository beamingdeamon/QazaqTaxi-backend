<?php
/**
 * Created by PhpStorm.
 * User: apporio
 * Date: 30/1/23
 * Time: 3:50 PM
 */

namespace App\Http\Controllers\PaymentMethods;


use App\Traits\ApiResponseTrait;
use App\Traits\MerchantTrait;
use App\Models\CreditAccountDetail;
use App\Http\Controllers\PaymentMethods\GlomoMoney\GlomoMoney;

class CreditAccountDetailController
{
    use ApiResponseTrait, MerchantTrait;

    public function makeTransfer(CreditAccountDetail $creditAccountDetail, $amount, $glomo_money_transaction_id = NULL) : array
    {
        $string_file = $this->getStringFile($creditAccountDetail->merchant_id);
        $slug = $creditAccountDetail->PaymentOption->slug;
        $flag = false;
        $transaction_id = "";
        switch ($slug) {
            case "GLOMO_MONEY":
                $params = array(
                    "merchant_id" => $creditAccountDetail->merchant_id,
                    "amount" => $amount,
                    "glomo_money_transaction_id" => $glomo_money_transaction_id,
                    "phone_number" => $creditAccountDetail->phone_number,
                    "amount" => $amount,
                );
                $glomo = new GlomoMoney();
                $flag = true;
                $transaction_id = $glomo->makeTransfer($params);
                break;
            default:
                throw new \Exception("Invalid Payment Option");
        }
        return array("flag" => $flag, "transaction_id" => $transaction_id);
    }
}
