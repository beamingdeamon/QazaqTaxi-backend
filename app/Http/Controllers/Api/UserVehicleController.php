<?php

namespace App\Http\Controllers\Api;

use App\Models\CarpoolingRide;
use App\Models\Onesignal;
use App\Models\User;
use App\Models\UserVehicle;
use App\Models\VehicleRequest;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageTrait;
use App\Traits\MerchantTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserVehicleController extends Controller
{
    use ApiResponseTrait, MerchantTrait, ImageTrait;

    public function addVehicle(Request $request)
    {
        $merchant_id = $request->merchant_id;
        $validator = Validator::make($request->all(), [
            'area_id' => 'required|exists:country_areas,id',
            'vehicle_type_id' => 'required',
            'vehicle_make_id' => 'required',
            'vehicle_model_id' => 'required',
            'vehicle_number' => ['required',
                Rule::unique('user_vehicles', 'vehicle_number')->where(function ($query) use ($merchant_id) {
                    return $query->whereNull('vehicle_delete')->where([['merchant_id', '=', $merchant_id]]);
                })],
            'vehicle_color' => 'required',
            'vehicle_image' => 'required|file',
            'vehicle_number_plate_image' => 'required|file',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }
        DB::beginTransaction();
        try {
            $user = $request->user('api');
            $user->country_area_id = $request->area_id;
            $user->save();
            $image = $this->uploadImage('vehicle_image', 'user_vehicle_document', $merchant_id);
            $image1 = $this->uploadImage('vehicle_number_plate_image', 'user_vehicle_document', $merchant_id);
            //check user already have any vehicle or not
            $user_vehicle = UserVehicle::where([['merchant_id', '=', $merchant_id], ['user_id', '=', $user->id]])->first();
            $vehicle = UserVehicle::create([
                'user_id' => $user->id,
                'owner_id' => $user->id,
                'merchant_id' => $merchant_id,
                'vehicle_type_id' => $request->vehicle_type_id,
                'shareCode' => getRandomCode(10),
                'vehicle_make_id' => $request->vehicle_make_id,
                'vehicle_model_id' => $request->vehicle_model_id,
                'vehicle_number' => $request->vehicle_number,
                'vehicle_color' => $request->vehicle_color,
                'vehicle_image' => $image,
                'vehicle_number_plate_image' => $image1,
                'ac_nonac' => $request->ac_nonac,
                'vehicle_verification_status' => 1,  //Pending with document
                'vehicle_register_date' => $request->vehicle_register_date
            ]);

            if (!empty($user_vehicle)) {
                $vehicle->Users()->attach($user->id, ['vehicle_active_status' => 2, 'user_default_vehicle' => 2]);
            } else {
                $vehicle->Users()->attach($user->id, ['vehicle_active_status' => 2, 'user_default_vehicle' => 1]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        $return_data = array('user_vehicle_id' => $vehicle->id);
        return $this->successResponse(trans("common.success"), $return_data);
    }

    public function VehicleRequest(Request $request)
    {
        $merchant_id = $request->merchant_id;
        $user_id = $request->user_id;
        $validator = Validator::make($request->all(), [
            'user_id' => ['required',
                Rule::exists('users', 'id')->where(function ($query) use ($merchant_id) {
                    return $query->where([['merchant_id', '=', $merchant_id]]);
                })],
            'code' => ['required',
                Rule::exists('user_vehicles', 'shareCode')->where(function ($query) use ($merchant_id, &$user_id) {
                    return $query->where([['merchant_id', '=', $merchant_id], ['owner_id', '!=', $user_id]]);
                })],
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }
        DB::beginTransaction();
        try {
            $string = $this->getStringFile($merchant_id);
            $vehicle = UserVehicle::where([['vehicle_verification_status', '=', 2], ['shareCode', '=', $request->code], ['merchant_id', '=', $merchant_id]])->first();
            if (empty($vehicle->id)) {
                return $this->failedResponse(trans("$string.vehicle_document_rejected"));
            }
            $otp = rand(999, 9999);
            $vehiclerequest = VehicleRequest::updateOrCreate(
                ['user_vehicle_id' => $vehicle->id, 'user_id' => $request->user_id],
                [
                    'otp' => $otp,
                    'status' => 1,
                ]
            );
            $large_icon = $large_icon = isset($item->Merchant[0]['pivot']->segment_icon) && !empty($item->Merchant[0]['pivot']->segment_icon) ? get_image($item->Merchant[0]['pivot']->segment_icon, 'segment', $merchant_id, true) :
                get_image($item->icon, 'segment_super_admin', NULL, false);
            $message = trans('common.your') . ' ' . trans("$string.vehicle") . ' ' . trans('common.approval') . ' ' . trans('common.code') . ' ' . trans('common.is') . ' : ' . $otp;
            $title = trans("$string.vehicle") . ' ' . trans("$string.sharing");
            $arr_param['user_id'] = $vehicle->user_id;
            $arr_param['data'] = $vehiclerequest;
            $arr_param['message'] = $message;
            $arr_param['merchant_id'] = $merchant_id;
            $arr_param['title'] = $title; // notification title
            $arr_param['large_icon'] = $large_icon;
            Onesignal::UserPushMessage($arr_param);

            $vehicle->vehicle_image = get_image($vehicle->vehicle_image, 'vehicle_document', $merchant_id);
            $vehicle->vehicle_number_plate_image = get_image($vehicle->vehicle_number_plate_image, 'vehicle_document', $merchant_id);
            $vehicle->VehicleTypeName = $vehicle->VehicleType->VehicleTypeName;
        } catch (\Exception $e) {
            DB::rollback();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        $message = trans("$string.vehicle") . ' ' . trans("$string.sharing") . ' ' . trans('common.request') . ' ' . trans('common.created') . ' ' . trans('common.successfully');
        return $this->successResponse($message, $vehicle);
    }

    public function vehicleOtpVerify(Request $request)
    {
        $merchant_id = $request->merchant_id;
        $user_vehicle_id = $request->user_vehicle_id;
        $validator = Validator::make($request->all(), [
            'user_vehicle_id' => ['required',
                Rule::exists('user_vehicles', 'id')->where(function ($query) use ($merchant_id) {
                    return $query->where([['merchant_id', '=', $merchant_id]]);
                })],
            'user_id' => ['required',
                Rule::exists('vehicle_requests', 'user_id')->where(function ($query) use ($user_vehicle_id) {
                    return $query->where([['user_vehicle_id', '=', $user_vehicle_id]]);
                })],
            'otp' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }
        DB::beginTransaction();
        try {
            $string = $this->getStringFile($merchant_id);
            $vehicleRequest = VehicleRequest::where([['user_vehicle_id', '=', $user_vehicle_id], ['user_id', '=', $request->user_id]])->first();
            if ($request->otp != $vehicleRequest->otp) {
                return $this->failedResponse(trans('common.otp_for_verification') . ' ' . trans('common.failed'));
            }
            $vehicle = UserVehicle::find($user_vehicle_id);
            $vehicle->Users()->attach($request->user_id, ['vehicle_active_status' => 2], ['user_default_vehicle' => 2]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        return $this->successResponse(trans("$string.vehicle") . ' ' . trans('common.added_successfully'));
    }

    public function userVehicleDefault(Request $request)
    {
        $user = $request->user('api');
        $merchant_id = $user->merchant_id;
        $validator = Validator::make($request->all(), [
            'vehicle_id' => ['required',
                Rule::exists('user_vehicles', 'id')->where(function ($query) use ($merchant_id) {
                    return $query->where([['merchant_id', '=', $merchant_id], ['vehicle_verification_status', '=', 2]]);
                })],
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->failedResponse("Vehicle documents are pending for approval");
        }
        DB::beginTransaction();
        try {
            $string = $this->getStringFile($user->merchant_id);
            $carpooling_ride = CarpoolingRide::where([['user_vehicle_id', '=', $request->vehicle_id], ['ride_status', '=', 3]])->first();
            if (!empty($carpooling_ride)) {
                $message = trans("$string.vehicle") . " " . trans("common.is") . " " . trans("common.not") . " " . trans("common.free");
                return $this->failedResponse($message);
            }
            // vehicle is already default or not for other users
            $vehicle = UserVehicle::whereHas('Users', function ($query) use ($user) {
                $query->where([['user_id', '=', $user->id], ['vehicle_active_status', '=', 1], ['user_default_vehicle', '=', 1]]);
            })->with(['Users' => function ($query) use ($user) {
                $query->where([['user_id', '=', $user->id], ['vehicle_active_status', '=', 1], ['user_default_vehicle', '=', 1]]);
            }])->find($request->vehicle_id);

            if (!empty($vehicle)) {
                $message = trans("common.vehicle") . " " . trans("common.already") . " " . trans("common.default") . " " . trans("common.by") . " " . trans("common.other") . " " . trans("common.user");
                return $this->successResponse($message); //Vehicle already default by other user
            }
            // check old default vehicle and make it normal one
            $vehicle_list = UserVehicle::whereHas('Users', function ($query) use ($user) {
                $query->where([['user_id', '=', $user->id], ['vehicle_active_status', '=', 1], ['user_default_vehicle', '=', 1]]);
            })->with(['Users' => function ($query) use ($user) {
                $query->where([['user_id', '=', $user->id], ['vehicle_active_status', '=', 1], ['user_default_vehicle', '=', 1]]);
            }])->get();
            if ($vehicle_list->isEmpty()) {
                return $this->failedResponse(trans('common.data_not_found'));
            }
            if (!$vehicle_list->isEmpty()) {
                foreach ($vehicle_list as $value) {
                    $value->Users()->updateExistingPivot(['user_id' => $user->id],
                        ['user_default_vehicle' => 2]);
                }
                $new_vehicle = UserVehicle::whereHas('Users', function ($query) use ($user) {
                    $query->where([['user_id', '=', $user->id], ['vehicle_active_status', '=', 1], ['user_default_vehicle', '=', 2]]);
                })->with(['Users' => function ($query) use ($user) {
                    $query->where([['user_id', '=', $user->id], ['vehicle_active_status', '=', 1], ['user_default_vehicle', '=', 2]]);
                }])->find($request->vehicle_id);
                $new_vehicle->Users()->updateExistingPivot(
                    ['user_id' => $user->id],
                    ['user_default_vehicle' => 1]
                );
            }
            $message = trans("$string.vehicle") . ' ' . trans("common.default") . ' ' . trans("common.added") . ' ' . trans("common.successfully");
        } catch (\Exception $e) {
            DB::rollback();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        return $this->successResponse($message);
    }

    public function UserVehicleList(Request $request)
    {
        $user = $request->user('api');
        $user_id = $user->id;
        DB::beginTransaction();
        try {
            $vehicle_list = [];
            if (!empty($user->UserVehicles)) {
                foreach ($user->UserVehicles as $vehicle) {
                    $vehicle_list[] = array(
                        "id" => $vehicle->id,
                        "vehicle_number" => $vehicle->vehicle_number,
                        "vehicle_model_name" => $vehicle->VehicleModel->VehicleModelName,
                        "vehicle_make_name" => $vehicle->VehicleMake->VehicleMakeName,
                        "vehicle_type_name" => $vehicle->VehicleType->VehicleTypeName,
                        "vehicle_image" => get_image($vehicle->VehicleType->vehicleTypeImage, 'user_vehicle_document', $user->merchant_id),
                        "vehicle_color" => $vehicle->vehicle_color,
                        "vehicle_default" => ($vehicle->pivot->user_default_vehicle == 1),
                        "vehicle_active" => ($vehicle->pivot->vehicle_active_status == 1)
                    );
                }
            }
            $data = array('vehicle_list' => $vehicle_list);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        return $this->successResponse(trans("common.success"), $data);
    }
    
    public function VehicleDelete(Request $request)
    {
        $merchant_id = $request->merchant_id;
         $user = $request->user('api');
        $validator = Validator::make($request->all(), [
            'vehicle_id' => ['required',
                Rule::exists('user_vehicles', 'id')->where(function ($query) use ($merchant_id) {
                    return $query->where([['merchant_id', '=', $merchant_id], ['vehicle_verification_status', '=', 2]]);
                })],
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }
        DB::beginTransaction();
        try {
            // check vehicle is ride is active or upcoming status
            $check_vehicle = CarpoolingRide::where([['merchant_id', $merchant_id],['user_id','=',$user->id]])->whereIn('ride_status', [1, 2])->first();
            if (!empty($check_vehicle)) {
                $message = trans("common.vehicle_cannot_deleted_its_active_in_other_ride");
                return $this->failedResponse($message);
            }

            $user_vehicle = UserVehicle::find($request->vehicle_id);
            $user_vehicle->delete();
            $message = trans("common.vehicle") . " " . trans("common.deleted");
        } catch (\Exception $e) {
            DB::rollback();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        return $this->successResponse($message);
    }
}
