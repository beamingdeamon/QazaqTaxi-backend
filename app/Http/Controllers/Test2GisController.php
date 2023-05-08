<?php

namespace App\Http\Controllers\Merchant;

use App\Models\AccountType;
use App\Models\InfoSetting;
use App\Models\LangName;
use App\Models\VersionManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\MerchantTrait;

class AccountTypeController extends Controller
{
    public function index(Request $request)
    {
        $checkPermission = check_permission(1, 'create-account-types');
        if ($checkPermission['isRedirect']) {
            return $checkPermission['redirectBack'];
        }
        Validator::make($request->all(),[
            'point_a_a'=>'required',
            'point_a_b'=>'required',
            'point_b_a' => 'integer|required|between:0,1'
            'point_b_b' => 'integer|required|between:0,1'
            'distance' => 'integer|required|between:0,1'
        ],[
            'status.between' => trans('admin.invalid_status'),
        ])->validate();
        
    }

   
}
