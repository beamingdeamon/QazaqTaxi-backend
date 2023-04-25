<?php

namespace App\Http\Controllers\Merchant;

use App\Models\InfoSetting;
use App\Models\VehicleMake;
use Auth;
use App;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Traits\ImageTrait;
use App\Traits\MerchantTrait;

class VehicleMakeController extends Controller
{
    use ImageTrait, MerchantTrait;

    public function __construct()
    {
        $info_setting = InfoSetting::where('slug', 'VEHICLE_MAKE')->first();
        view()->share('info_setting', $info_setting);
    }

    public function index(Request $request)
    {
        $merchant_id = get_merchant_id();
        $checkPermission =  check_permission(1, 'view_vehicle_make');
        if ($checkPermission['isRedirect']) {
            return  $checkPermission['redirectBack'];
        }
        $vehicle_make = $request->vehicle_make;

        $query = VehicleMake::where([['merchant_id', '=', $merchant_id], ['admin_delete', '=', NULL]]);
        if (!empty($vehicle_make)) {
            $query->with(['LanguageVehicleMakeSingle' => function ($q) use ($vehicle_make, $merchant_id) {
                $q->where('vehicleMakeName', $vehicle_make)->where('merchant_id', $merchant_id);
            }])->whereHas('LanguageVehicleMakeSingle', function ($q) use ($vehicle_make, $merchant_id) {
                $q->where('vehicleMakeName', $vehicle_make)->where('merchant_id', $merchant_id);
            });
        }

        $vehiclemakes = $query->paginate(10);
        $arr_vehicle_make['search_route'] = route('vehiclemake.index');
        $arr_vehicle_make['arr_search'] = $request->all();
        $arr_vehicle_make['merchant_id'] = $merchant_id;
        $arr_vehicle_make['vehicle_make'] = $vehicle_make;

        return view('merchant.vehiclemake.index', compact('vehiclemakes', 'arr_vehicle_make'));
    }

    public function store(Request $request)
    {
        $merchant = get_merchant_id(false);
        $string_file = $this->getStringFile(NULL, $merchant);
        $merchant_id = $merchant->id;
        $locale = App::getLocale();
        $this->validate($request, [
            // 'vehicle_make' => ['required',
            //     Rule::unique('language_vehicle_makes', 'vehicleMakeName')->where(function ($query) use ($merchant_id) {
            //         return $query->where([['merchant_id', '=', $merchant_id], ['locale', '=', App::getLocale()]]);
            //     })],
            'vehicle_make_logo' => "required",
            'description' => 'required',
            'vehicle_make' => 'required'
        ]);


        $make = DB::table('language_vehicle_makes')->select('vehicle_makes.id')
            ->where(function ($query) use ($merchant_id, &$locale, $request) {
                $query->where([['language_vehicle_makes.merchant_id', '=', $merchant_id], ['locale', '=', $locale], ['vehiclemakeName', '=', $request->vehicle_make]]);
            })->join('vehicle_makes', 'vehicle_makes.id', '=', 'language_vehicle_makes.vehicle_make_id')
->where('admin_delete','=',null)
            ->first();

        DB::beginTransaction();
        try {
            if (empty($make->id)) {
                $vehicle_make = VehicleMake::create([
                    'merchant_id' => $merchant_id,
                    'vehicleMakeLogo' => $this->uploadImage('vehicle_make_logo', 'vehicle'),
                ]);
                $this->SaveLanguageVehicle($merchant_id, $vehicle_make->id, $request->vehicle_make, $request->description);
                
            } else {
                return redirect()->back()->withErrors(trans("$string_file.vehicle_make_already_exist"));
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            p($message);
            // Rollback Transaction
            DB::rollback();
        }
        DB::commit();
        return redirect()->back()->withSuccess(trans("$string_file.added_successfully"));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $checkPermission =  check_permission(1, 'edit_vehicle_type');
        if ($checkPermission['isRedirect']) {
            return  $checkPermission['redirectBack'];
        }
        $merchant = get_merchant_id(false);
        $is_demo = $merchant->demo == 1 ? true : false;
        $merchant_id = $merchant->id;
        $vehiclemake = VehicleMake::where([['merchant_id', '=', $merchant_id]])->find($id);
        return view('merchant.vehiclemake.edit', compact('vehiclemake', 'is_demo'));
    }

    public function update(Request $request, $id)
    {
        $locale = App::getLocale();
        $merchant = get_merchant_id(false);
        $string_file = $this->getStringFile(NULL, $merchant);
        $merchant_id = $merchant->id;
       
        $request->validate([
            // 'vehicle_make' => [
            //     'required', 'max:255',
            //     Rule::unique('language_vehicle_makes', 'vehicleMakeName')->where(function ($query) use ($merchant_id, &$locale, &$id) {
            //         $query->where([['merchant_id', '=', $merchant_id], ['locale', '=', $locale], ['vehicle_make_id', '!=', $id]]);
            //     })
            // ],
            'description' => 'required',
            'vehicle_make' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $make = DB::table('language_vehicle_makes')->select('vehicle_makes.id')
                ->where(function ($query) use ($merchant_id, &$locale, $request, $id) {
                    $query->where([['language_vehicle_makes.merchant_id', '=', $merchant_id], ['locale', '=', $locale], ['vehiclemakeName', '=', $request->vehicle_make], ['vehicle_make_id', '!=', $id]]);
                })
                ->join('vehicle_makes', 'vehicle_makes.id', '=', 'language_vehicle_makes.vehicle_make_id')
                ->where('admin_delete','=',null)

                ->first();

            if (empty($make->id)) {
                $vehicleMake = VehicleMake::where([['merchant_id', '=', $merchant_id]])->findorFail($id);
                if ($request->hasFile('vehicleMakeLogo')) {
                    $vehicleMake->vehicleMakeLogo = $this->uploadImage('vehicleMakeLogo', 'vehicle');
                    $vehicleMake->save();
                }
                $this->SaveLanguageVehicle($merchant_id, $id, $request->vehicle_make, $request->description);
            } else {
                return redirect()->back()->withErrors(trans("$string_file.already_exist"));
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            p($message);
            // Rollback Transaction
            DB::rollback();
        }
        DB::commit();
        return redirect()->back()->withSuccess(trans("$string_file.added_successfully"));
    }

    public function SaveLanguageVehicle($merchant_id, $vehicle_make_id, $name, $description)
    {
        App\Models\LanguageVehicleMake::updateOrCreate([
            'merchant_id' => $merchant_id, 'locale' => App::getLocale(), 'vehicle_make_id' => $vehicle_make_id
        ], [
            'vehicleMakeName' => $name,
            'vehicleMakeDescription' => $description,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $delete = VehicleMake::FindorFail($id);
        $string_file = $this->getStringFile(NULL, $delete->Merchant);
        if (!empty($delete->id)) :
            $delete->admin_delete = 1;
            $delete->save();
            echo trans("$string_file.data_deleted_successfully");
        else :
            echo trans("$string_file.some_thing_went_wrong");
        endif;
    }
}
