<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Helper\CommonController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use DateTime;
use App\Models\BusinessSegment\Order;
use \App\Models\Segment;

class DriverBackup extends Authenticatable
{
    use Notifiable, HasApiTokens;
    protected $hidden = ['pivot'];

    protected $guarded = [];
    // socket true means get drivers lat long from node+mongodb
    public static $socket = true;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->merchant_driver_id = $model->NewDriverId($model->merchant_id);
            return $model;
        });
    }

    public function NewDriverId($merchantID)
    {
        $driver = Driver::where([['merchant_id', '=', $merchantID]])->latest()->first();
        if (!empty($driver)) {
            return $driver->merchant_driver_id + 1;
        } else {
            return 1;
        }
    }

    public function OutStandings()
    {
        return $this->hasMany(OutStanding:: class);
    }

    public function ActiveAddress()
    {
        return $this->hasOne(DriverAddress::class)->where('address_status', 1);
    }

    public function DriverVehicle()
    {
        return $this->belongsToMany(DriverVehicle::class)->withPivot('vehicle_active_status');
    }

    public function Franchisee()
    {
        return $this->belongsToMany(Franchisee::class);
    }

    public function BookingRequestDriver()
    {
        return $this->hasMany(BookingRequestDriver::class);
    }

    public function getfullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function DriverAccount()
    {
        return $this->hasMany(DriverAccount::class);
    }

    public function DriverDocument()
    {
        return $this->hasMany(DriverDocument::class);
    }

    public function Booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function Merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function CountryArea()
    {
        return $this->belongsTo(CountryArea::class);
    }

    public function DriverVehicles()
    {
        return $this->hasMany(DriverVehicle::class);
    }

    public function FirstVehicle()
    {
        return $this->hasOne(DriverVehicle::class, 'owner_id');
    }

    public static function UpdateDetails($id, $data)
    {
        Driver::where([['id' => $id]])->update($data);
    }

    public function DriverRideConfig()
    {
        return $this->hasOne(DriverRideConfig::class);
    }

    public function DriverCurrentActivePack()
    {
        return $this->hasOne(DriverActivePack::class);
    }

    public function DriverSubscriptionRecord()
    {
        return $this->hasMany(DriverSubscriptionRecord::class);
    }
    public function DriverWalletTransaction()
    {
        return $this->hasMany(DriverWalletTransaction::class);
    }

    public function DriverCard()
    {
        return $this->hasMany(DriverCard::class);
    }

    public function AccountType()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function ReferralDriverDiscount()
    {
        return $this->hasMany(ReferralDriverDiscount::class);
    }

    public function GeofenceAreaQueue()
    {
        return $this->hasMany(GeofenceAreaQueue::class);
    }
    public function Segment()
    {
        return $this->belongsToMany(Segment::class);
    }
    function ServiceTimeSlotDetail()
    {
        return $this->belongsToMany(ServiceTimeSlotDetail::class,'driver_service_time_slot_detail','driver_id')->withPivot('segment_id');
    }
    public function DriverSegmentRating()
    {
        return $this->hasMany(DriverSegmentRating:: class);
    }
    public function ServiceType()
    {
        return $this->belongsToMany(ServiceType:: class,'driver_service_type','driver_id')->withPivot('segment_id');
    }

    public function ServiceTypeOnline()
    {
        return $this->belongsToMany(ServiceType:: class,'driver_online','driver_id')->withPivot('segment_id','driver_vehicle_id');
    }

    public function DriverGallery()
    {
        return $this->hasMany(DriverGallery:: class);
    }
    public function SegmentPriceCard()
    {
        return $this->hasMany(SegmentPriceCard:: class);
    }

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
    public function DriverSegmentDocument()
    {
        return $this->hasMany(DriverSegmentDocument::class);
    }
    public function Order()
    {
        return $this->hasMany(Order::class);
    }

    public function findForPassport($user_cred = null)
    {
        if (!empty($_SERVER['HTTP_PUBLICKEY']) && !empty($_SERVER['HTTP_SECRETKEY'])) {
            $merchant = CommonController::MerchantObj($_SERVER['HTTP_PUBLICKEY'], $_SERVER['HTTP_SECRETKEY']);
            $driver_login = $merchant->ApplicationConfiguration->driver_login;
            $merchant_id = $merchant['id'];
        }
        if ($driver_login == "EMAIL") {
            return Driver::where([['merchant_id', '=', $merchant_id], ['email', '=', $user_cred], ['driver_admin_status', '=', 1]])->latest()->first();
        } else {
            return Driver::where([['merchant_id', '=', $merchant_id], ['phoneNumber', '=', $user_cred], ['driver_admin_status', '=', 1]])->latest()->first();
        }
    }

    public function GenrateReferCode()
    {
        $code = getRandomCode();
        if ($this->CheckReferCode($code)) {
            return $this->GenrateReferCode();
        }
        return $code;
    }

    public function CheckReferCode($referCode)
    {
        return static::where([['driver_referralcode', '=', $referCode]])->exists();
    }

    public static function Logout($player, $merchant_id)
    {
        Driver::where([['merchant_id', '=', $merchant_id], ['player_id', '=', $player]])->update(['online_offline' => 2, 'login_logout' => 2]);
    }
    // common function to get driver
    public static function GetNearestDriver($arr_reqest)
    {
        // query parameters
        $limit = isset($arr_reqest['limit']) ? $arr_reqest['limit'] :10;
        $area = isset($arr_reqest['area']) ? $arr_reqest['area'] :null;
        $distance_unit = isset($arr_reqest['distance_unit']) ? $arr_reqest['distance_unit'] :'';
//        $driver_request_time_out = isset($arr_reqest['driver_request_time_out']) ? $arr_reqest['driver_request_time_out'] :null;
        $service_type_id = isset($arr_reqest['service_type']) ? $arr_reqest['service_type'] :null;
        $vehicle_type_id = isset($arr_reqest['vehicle_type']) ? $arr_reqest['vehicle_type'] :null;
        $longitude = isset($arr_reqest['longitude']) ? $arr_reqest['longitude'] :null;
        $latitude = isset($arr_reqest['latitude']) ? $arr_reqest['latitude'] :null;
        $ac_nonac = isset($arr_reqest['ac_nonac']) ? $arr_reqest['ac_nonac'] :null;
        $user_gender = isset($arr_reqest['user_gender']) ? $arr_reqest['user_gender'] :null;
        $driver_ids = isset($arr_reqest['driver_ids']) ? $arr_reqest['driver_ids'] :[];
        $baby_seat = isset($arr_reqest['baby_seat']) ? $arr_reqest['baby_seat'] :null;
        $wheel_chair = isset($arr_reqest['wheel_chair']) ? $arr_reqest['wheel_chair'] :null;
        $riders_num = isset($arr_reqest['riders_num']) ? $arr_reqest['riders_num'] :null;
        $distance = isset($arr_reqest['distance']) ? $arr_reqest['distance'] :1;
        $vehicleTypeRank = isset($arr_reqest['vehicleTypeRank']) ? $arr_reqest['vehicleTypeRank'] :null; // check higher rank vehicle type in case of auto upgrade
        $radius = $distance_unit == 2 ? 3958.756 : 6367;
        $select = isset($arr_reqest['select']) ? $arr_reqest['select'] : '*';
        $type = isset($arr_reqest['type']) ? $arr_reqest['type'] : null;  //for admin driver map
        $taxi_company_id = isset($arr_reqest['taxi_company_id']) ? $arr_reqest['taxi_company_id'] : null;
        $isManual = isset($arr_reqest['isManual']) ? $arr_reqest['isManual'] : null;
        $drop_lat = isset($arr_reqest['drop_lat']) ? $arr_reqest['drop_lat'] : null;
        $drop_long = isset($arr_reqest['drop_long']) ? $arr_reqest['drop_long'] : null;
        $bookingId = isset($arr_reqest['booking_id']) ? $arr_reqest['booking_id'] : null;
        $base_areas = null;

        $queue_system = false;
        $queue_drivers = [];

        if(!empty($longitude) && !empty($latitude))
        {
            $merchantData = CountryArea::find($area);
            $merchant = Merchant::with('Configuration','DriverConfiguration','ApplicationConfiguration')
                ->where([['id', '=', $merchantData->merchant_id]])->first();

            if(isset($merchantData->is_geofence) && $merchantData->is_geofence == 1){
                $base_areas = isset($merchantData->RestrictedArea->base_areas) ? explode(',',$merchantData->RestrictedArea->base_areas) : '';
                if(isset($merchantData->RestrictedArea) && $merchantData->RestrictedArea->queue_system == 1){
                    $queue_system = true;
                    $queue_drivers = GeofenceAreaQueue::where([
                        ['merchant_id', '=', $merchant->id],
                        ['geofence_area_id','=',$merchantData->id],
                        ['queue_status', '=', 1], /// Check for entry queue
                        ['exit_time', '=', null]
                    ])->where(function($query) use ($base_areas){
                        if(!empty($base_areas)){
                            $query->whereIn('country_area_id',$base_areas);
                        }
                    })->whereDate('entry_time',date('Y-m-d'))->orderBy('queue_no')->pluck('driver_id')->toArray();
                    $driver_ids = $queue_drivers;
                }
            }
            $merchantGender = isset($merchant->ApplicationConfiguration->gender) ? $merchant->ApplicationConfiguration->gender : NULL;
            $area_notifi = isset($merchant->Configuration->driver_area_notification) ? $merchant->Configuration->driver_area_notification : null;
            $minute = isset($merchant->DriverConfiguration->inactive_time) ? $merchant->DriverConfiguration->inactive_time : null;
            $location_updated_last_time = '';
            if($minute > 0)
            {
                $date = new DateTime;
                $date->modify("-$minute minutes");
                $location_updated_last_time = $date->format('Y-m-d H:i:s');
            }

            $drivers = [];
            $query = Driver::select($select)
                ->addSelect(DB::raw('( ' . $radius . ' * acos( cos( radians(' . $latitude . ') ) * cos( radians( current_latitude ) ) * cos( radians( current_longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( current_latitude ) ) ) ) AS distance,drivers.id AS driver_id'))
                ->join('driver_driver_vehicle', 'drivers.id', '=', 'driver_driver_vehicle.driver_id')
                ->join('driver_vehicles', 'driver_driver_vehicle.driver_vehicle_id', '=', 'driver_vehicles.id')
                ->join('driver_driver_vehicle', 'driver_driver_vehicle.driver_vehicle_id', '=', 'driver_vehicles.id');

            if($taxi_company_id != null || $isManual == true){
                $query->where('drivers.taxi_company_id',$taxi_company_id);
            }

            if($service_type_id == 5)
            {
                // pool service type
                $query->where([['drivers.status_for_pool', '!=', 2008], ['drivers.pool_ride_active', '=', 1], ['drivers.avail_seats', '>=', $riders_num]]);
                $query->whereIn('drivers.free_busy',[1,2]);
            }
            else{
                $query->join('driver_vehicle_service_type', 'driver_driver_vehicle.driver_vehicle_id', '=', 'driver_vehicle_service_type.driver_vehicle_id');
                $query->where('driver_vehicle_service_type.service_type_id',$service_type_id);
                $query->where([['drivers.free_busy', '=', 2]]);
            }

            if(!empty($vehicleTypeRank))
            {
                $query->join('driver_ride_configs', 'drivers.id', '=', 'driver_ride_configs.driver_id');
                $query->join('vehicle_types', 'driver_vehicles.vehicle_type_id', '=', 'vehicle_types.id');
                $query->where([['vehicle_types.vehicleTypeRank', '<=', $vehicleTypeRank], ['driver_ride_configs.auto_upgradetion', '=', 1]]);
                //in auto upgrade case next rank vehicle type will be searched
                $vehicle_type_id = null;
            }
            $query->where([
//                ['drivers.free_busy', '=', 2],
                ['drivers.player_id', "!=", NULL],
                ['login_logout', '=', 1],
                ['drivers.online_offline', '=', 1],
                ['driver_vehicles.vehicle_active_status', '=', 1],
                ['driver_driver_vehicle.vehicle_active_status', '=', 1],
                ['drivers.driver_delete', '=', NULL]
            ])
                ->where(function($q) use($location_updated_last_time){
                    $q->where('last_location_update_time', '>=', $location_updated_last_time);
                })
                ->whereRaw('( is_suspended is NULL or is_suspended < ? )' , [date('Y-m-d H:i:s')])
                ->where(function($q) use ($area_notifi, $area, $base_areas){
                    if($area_notifi == 2)
                    {
                        if(!empty($base_areas)){
                            array_push($base_areas,$area);
                            $q->whereIn('drivers.country_area_id', $base_areas);
                        }else{
                            $q->where('drivers.country_area_id', $area);
                        }
                    }
                })
                ->where(function($q) use ($vehicle_type_id){
                    if(!empty($vehicle_type_id))
                    {
                        $q->where('driver_vehicles.vehicle_type_id', $vehicle_type_id);
                    }
                })
                ->where(function ($query) use ($ac_nonac) {
                    if ($ac_nonac == 1) {
                        return $query->where('driver_vehicles.ac_nonac', $ac_nonac);
                    }
                })
                ->where(function ($query) use ($user_gender,$merchantGender) {
                    if (!empty($user_gender) && $merchantGender == 1) {
                        return $query->where('drivers.driver_gender', $user_gender);
                    }
                })
                ->where(function ($query) use ($wheel_chair) {
                    if ($wheel_chair == 1) {
                        return $query->where('driver_vehicles.wheel_chair', $wheel_chair);
                    }
                })
                ->where(function ($query) use ($driver_ids) {
                    if (!empty($driver_ids))
                    {
                        return $query->whereIn('drivers.id', $driver_ids);
                    }
                })
                ->where(function ($query) use ($baby_seat) {
                    if ($baby_seat == 1) {
                        return $query->where('driver_vehicles.baby_seat', $baby_seat);
                    }
                })
                ->whereNOTIn('drivers.id', function ($query) use($bookingId){
                    $query->select('brd.driver_id')
                        ->from('booking_request_drivers as brd')
                        ->join('bookings as b', 'brd.booking_id', '=', 'b.id')
                        ->where('b.booking_status', '=', 1001)
                        ->where(function ($p) use($bookingId){
                            $p->where([['brd.booking_id',$bookingId],['brd.request_status',3]])->orWhere([['brd.request_status',1]]);
                        });
                })
                ->whereExists(function ($query) {
                    $query->select("ddv.driver_id")
                        ->from('driver_driver_vehicle as ddv')
                        ->join('driver_vehicles as dv', 'ddv.driver_vehicle_id', '=', 'dv.id')
                        ->where('ddv.vehicle_active_status', 1)
                        ->whereRaw('ddv.driver_id = drivers.id');
                })
                ->having('distance', '<', $distance)
                ->orderBy('distance')
                ->take($limit);
            $drivers = $query->get();
            if($queue_system){
                if(count($queue_drivers) > 0 && count($drivers) > 0 && $drop_lat != '' && $drop_long != ''){
                    $i = 0;
                    $found_driver = [];
                    foreach($drivers as $driver){
                        if($driver->driver_id == $queue_drivers[$i]){
                            array_push($found_driver, $driver);
                            break;
                        }
                    }
                    return $found_driver;
                }else{
                    return [];
                }
            }
        }else{
            if (!empty($type)){
                $merchant_id = get_merchant_id();
                $select = ['id', 'first_name', 'last_name', 'email', 'phoneNumber', 'profile_image', 'current_latitude', 'current_longitude', 'online_offline', 'free_busy'];
                $query = Driver::select($select)->where([['merchant_id', '=', $merchant_id], ['current_latitude', '!=', null], ['login_logout', '=', 1], ['driver_delete', '=', null]]);
                if ($type == 2) {
                    $query->where([['online_offline', '=', 1], ['free_busy', '=', 2]]);
                }elseif ($type == 3){
                    $query->where([['free_busy', '=', 1]])->whereHas('Booking', function ($query) {
                        $query->where([['booking_status', '=', 1002]]);
                    });
                }elseif ($type == 4){
                    $query->where([['free_busy', '=', 1]])->whereHas('Booking', function ($query) {
                        $query->where([['booking_status', '=', 1003]]);
                    });
                }elseif ($type == 5){
                    $query->where([['free_busy', '=', 1]])->whereHas('Booking', function ($query) {
                        $query->where([['booking_status', '=', 1004]]);
                    });
                }elseif ($type == 6){
                    $query->where([['online_offline', '=', 2]]);
                }
                $drivers = $query->get();
            }
        }
        if(count($drivers) == 0)
        {
            $drivers = [];
        }else{
            $home_address_active = isset($merchant->BookingConfiguration->home_address_enable) ? $merchant->BookingConfiguration->home_address_enable : NULL;
            if($home_address_active == 1){
                $total_driver_ids = array_pluck($drivers->toArray(), 'driver_id');
                $homelocation_driver_ids = array_pluck($drivers->where('home_location_active', 1)->toArray(), 'driver_id');
                $accepted_driver_ids = array_diff($total_driver_ids, $homelocation_driver_ids);
                if(!empty($drop_lat) && !empty($drop_long)){
                    if (!empty($homelocation_driver_ids)) {
                        $nearHomelocation = Driver::GetHomeLocationsNearestToDropLocation($homelocation_driver_ids, $drop_lat, $drop_long, $distance, $limit, $merchant);
                        if (!empty($nearHomelocation->toArray())) {
                            $homelocation_id = array_pluck($nearHomelocation, 'driver_id');
                            $newArray = array_intersect($homelocation_driver_ids, $homelocation_id);
                            $newArray = array_merge($newArray,$accepted_driver_ids);
                            $drivers = $drivers->whereIn('driver_id', $newArray);
                            if (empty($drivers->toArray())) {
                                return [];
                            }
                        }else{
                            $drivers = $drivers->where('home_location_active','!=', 1);
                            if(count($drivers) == 0){
                                $drivers = [];
                            }
                        }
                    }
                }
            }
        }
        return $drivers;
    }

    public static function GetHomeLocationsNearestToDropLocation(array $drivers, $latitude, $longitude, $distance, $limit, $merchant)
    {
        $date = new DateTime;
        $minute = isset($merchant->DriverConfiguration->inactive_time) ? $merchant->DriverConfiguration->inactive_time : null;
        $location_updated_last_time = '';
        if($minute > 0){
            $date = new DateTime;
            $date->modify("-$minute minutes");
            $location_updated_last_time = $date->format('Y-m-d H:i:s');
        }
        $drivers_active_home = DriverAddress::select(DB::raw('*, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance,driver_addresses.id AS driver_addresses_id'))
            ->join('drivers', 'driver_addresses.driver_id', '=', 'drivers.id')
            ->having('distance', '<', $distance)
            ->where([['driver_addresses.address_status', TRUE],
                ['last_location_update_time', '>=', $location_updated_last_time]])
            ->whereIn('driver_id', $drivers)
            ->orderBy('distance')
            ->take($limit)
            ->whereNOTIn('drivers.id', function ($query){
                $query->select('brd.driver_id')
                    ->from('booking_request_drivers as brd')
                    ->join('bookings as b', 'brd.booking_id', '=', 'b.id')
                    ->where('b.booking_status', '=', 1001);
            })
            ->get();
        return $drivers_active_home;
    }

    public static function CheckNewDropPointNearestToDropLocation($poolrideid, $latitude, $longitude, $distance)
    {
        $return_data = PoolRideList::select(DB::raw('*, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( drop_lat ) ) * cos( radians( drop_long ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( drop_lat ) ) ) ) AS distance'))
            ->having('distance', '<', $distance)
            ->where([['pool_ride_lists.id', '=', $poolrideid]])
            ->orderBy('distance')
            ->get();
        return $return_data;
    }

    // code merged by @Amba
    // Code of booking Delivery
    public static function GetNearestDriverDelivery($area, $latitude, $longitude, $distance = 1, $limit = 1, $vehicle_type_id, $service_type_id, $driver_request_time_out = 60)
    {
        $latitude = number_format($latitude,5,".","");
        $longitude = number_format($longitude,5,".","");
//        date_default_timezone_set('asia/kolkata');
        $current_date = date('Y-m-d H:i:s');
        $merchantData = CountryArea::select('merchant_id')->find($area);
        $driver_area_notification = Configuration::select('driver_area_notification')->where([['merchant_id', '=', $merchantData->merchant_id]])->first();
        if ($driver_area_notification->driver_area_notification == 1) {
            $formatted_check_date = date("Y-m-d H:i:s", time() - $driver_request_time_out);
            $drivers = Driver::select(DB::raw('*, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( current_latitude ) ) * cos( radians( current_longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( current_latitude ) ) ) ) AS distance,drivers.id AS driver_id'))
                ->join('driver_vehicles', 'drivers.id', '=', 'driver_vehicles.driver_id')
                ->join('driver_driver_vehicle', 'drivers.id', '=', 'driver_driver_vehicle.driver_id')
                ->having('distance', '<', $distance)
                ->where([['drivers.last_ride_request_timestamp', '<=', $formatted_check_date], ['drivers.free_busy', '=', 2], ['drivers.player_id', "!=", NULL], ['login_logout', '=', 1], ['drivers.online_offline', '=', 1], ['driver_vehicles.vehicle_type_id', '=', $vehicle_type_id], ['driver_driver_vehicle.vehicle_active_status', '=', 1]])
                ->whereRaw('( is_suspended is NULL or is_suspended < "'.$current_date.'" )')
                ->orderBy('distance')
                ->take($limit)
                ->get();

            return $drivers;
        } else {
            $formatted_check_date = date("Y-m-d H:i:s", time() - $driver_request_time_out);
            $drivers = Driver::select(DB::raw('*, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( current_latitude ) ) * cos( radians( current_longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( current_latitude ) ) ) ) AS distance,drivers.id AS driver_id'))
                ->join('driver_vehicles', 'drivers.id', '=', 'driver_vehicles.driver_id')
                ->join('driver_driver_vehicle', 'drivers.id', '=', 'driver_driver_vehicle.driver_id')
                ->where([['drivers.last_ride_request_timestamp', '<=', $formatted_check_date], ['drivers.free_busy', '=', 2], ['drivers.country_area_id', '=', $area], ['login_logout', '=',1], ['drivers.online_offline', '=', 1], ['driver_vehicles.vehicle_type_id', '=', $vehicle_type_id], ['driver_driver_vehicle.vehicle_active_status', '=', 1]])
                ->having('distance','<',$distance)
                ->whereRaw('( is_suspended is NULL or is_suspended < "'.$current_date.'" )')
                ->orderBy('distance')
                ->take($limit)
                ->get();
            return $drivers;
        }
    }

    public static function getNearestPlumbers($arr_reqest)
    {
          /*******NOTE*********/
        // pagination 2 : all drivers without pagination
        // pagination 1 & page value: drivers with pagination
        //pagination 1 without page value means only fav driver of that user

        $limit = isset($arr_reqest['limit']) ? $arr_reqest['limit'] :10;
        $segment_id = isset($arr_reqest['segment_id']) ? $arr_reqest['segment_id'] :NULL;
        $merchant_id = isset($arr_reqest['merchant_id']) ? $arr_reqest['merchant_id'] :null;
        $distance_unit = isset($arr_reqest['distance_unit']) ? $arr_reqest['distance_unit'] :'';
        $longitude = isset($arr_reqest['longitude']) ? $arr_reqest['longitude'] :null;
        $latitude = isset($arr_reqest['latitude']) ? $arr_reqest['latitude'] :null;
        $driver_ids = isset($arr_reqest['driver_ids']) ? $arr_reqest['driver_ids'] :[];
        $distance = isset($arr_reqest['distance']) ? $arr_reqest['distance'] :1;
        $radius = $distance_unit == 2 ? 3958.756 : 6367;
        $select = isset($arr_reqest['select']) ? $arr_reqest['select'] : '*';
        $user_id = isset($arr_reqest['user_id']) ? $arr_reqest['user_id'] : null;
        $pagination = isset($arr_reqest['pagination']) ? $arr_reqest['pagination'] : null;
//        $distance = isset($arr_reqest['distance']) ? $arr_reqest['distance'] : null;
        $popularity = isset($arr_reqest['popularity']) ? $arr_reqest['popularity'] : null;
        $price_low = isset($arr_reqest['price_low']) ? $arr_reqest['price_low'] : null;
        $price_high = isset($arr_reqest['price_high']) ? $arr_reqest['price_high'] : null;
        $page = isset($arr_reqest['page']) ? $arr_reqest['page'] : null;
        //$arr_services = isset($arr_reqest['selected_services']) ? $arr_reqest['selected_services'] : null;

        $drivers = [];
        $segment = Segment::Find($segment_id);
        $price_provider = isset($segment->Merchant[0]->price_card_owner) ? $segment->Merchant[0]->price_card_owner : 1;  //
        // 1 : merchant/admin , 2: provider/driver
        if(!empty($longitude) && !empty($latitude))
        {
            $query = Driver::select('drivers.id','drivers.first_name','drivers.last_name','country_area_id')
                ->addSelect('drivers.id AS driver_id,fd.driver_id as is_favourite,profile_image')
                ->addSelect('dsr.rating')
                ->join('driver_segment as ds','drivers.id','=','ds.driver_id')
                ->leftJoin('favourite_drivers as fd','drivers.id','=','fd.driver_id')
                ->leftJoin(DB::raw('(SELECT dsr.driver_id, CAST(AVG (dsr.rating) AS DECIMAL (2,1)) AS rating FROM `driver_segment_ratings` as dsr GROUP BY dsr.driver_id) dsr'),'drivers.id','=','dsr.driver_id')

                ->with(['ActiveAddress'=>function($q) use($radius,$latitude,$longitude,$distance)
                {
                    $q->addSelect(DB::raw('( ' . $radius . ' * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance,driver_id,latitude,longitude'))
                        ->orderBy('distance');
                    //->having('distance', '<', $distance);
                }])
                ->whereHas('ActiveAddress',function($q) {})
                ->whereHas('ServiceTypeOnline',function($q) use($segment_id) {
                    $q->where('driver_online.segment_id',$segment_id);
                })
                ->with(['ServiceType'=>function($q) use($segment_id,$merchant_id){
                    $q->with(['SegmentPriceCard'=>function($q) use($segment_id,$merchant_id){
                        //$q->addSelect('segment_price_cards.id','segment_price_cards.service_type_id','segment_price_cards.amount','segment_price_cards.price_type','segment_price_cards.driver_id');
                        $q->where('segment_id', $segment_id);
                        $q->where('merchant_id', $merchant_id);

                    }]);

                    $q->whereHas('SegmentPriceCard',function($q) use($segment_id,$merchant_id){
                        // $q->addSelect('segment_price_cards.id','segment_price_cards.service_type_id','segment_price_cards.amount','segment_price_cards.price_type','segment_price_cards.driver_id');
                        $q->where('segment_id', $segment_id);
                        $q->where('merchant_id', $merchant_id);
                    });


                    $q->with(['DriverOnline'=>function($q) use($segment_id) {
                        $q->where('driver_online.segment_id',$segment_id);
                    }]);

                    $q->whereHas('DriverOnline',function($q) use($segment_id) {
                        $q->where('driver_online.segment_id',$segment_id);
                    });

                }])

                ->whereHas('ServiceType', function ($q) use ($segment_id,$merchant_id) {
                    $q->where('driver_service_type.segment_id', $segment_id);

                });

            $query->where([
//                    ['drivers.player_id', "!=", NULL],
                ['drivers.segment_group_id', '=', 2],
                ['drivers.signupStep', '=', 9],
                ['drivers.driver_delete', '=', NULL],
                ['drivers.merchant_id', '=', $merchant_id],
                ['ds.segment_id', '=', $segment_id],
            ])
                 ->where(function($q) use($user_id,$page,$pagination){
                     if($pagination == 1 || $pagination == 2)
                     {
                         $q->where('fd.user_id',  $user_id);
                     }
                     if((!empty($page) && $page >= 1 && $pagination == 1) || $pagination == 2)
                     {
                         $q->orWhere('fd.user_id',  NULL);
                     }
                 })
                ->whereRaw('( is_suspended is NULL or is_suspended < ? )' , [date('Y-m-d H:i:s')])
                ->where(function ($query) use ($driver_ids) {
                    if (!empty($driver_ids))
                    {
                        return $query->whereIn('drivers.id', $driver_ids);
                    }
                })

                // ->groupBy('dsr.driver_id');
            ;

//                ->take($limit);
            if($popularity == 1 )
            {
                $query->orderBy('rating');
            }
//            if($popularity == 1 )
//            {
//                $query->orderBy('rating');;
//            }
            if($pagination == 1 && !empty($page))
            {
                $drivers = $query->paginate(6);
            }
            else
            {
                $drivers = $query->get();
            }
        }
        return $drivers;
    }

    public static function getPlumber($arr_reqest)
    {
        $merchant_id = $arr_reqest->merchant_id;
        $segment_id = $arr_reqest->segment_id;
        $id = $arr_reqest->id;
        $driver = Driver::select('drivers.id','drivers.first_name','drivers.last_name','drivers.profile_image','drivers.created_at','fd.is_favourite')
            ->addSelect(DB::raw("CAST(AVG (dsr.rating) AS DECIMAL (2,1)) AS rating"),'dsr.driver_id')
            ->leftJoin('driver_segment_ratings as dsr','drivers.id','=','dsr.driver_id')
            ->leftJoin(DB::raw('(SELECT fd.driver_id, count(fd.driver_id) AS is_favourite FROM `favourite_drivers` as fd where( segment_id="'.$segment_id.'" or segment_id IS NULL) GROUP BY fd.driver_id) fd'),'drivers.id','=','fd.driver_id')
            ->with(['ServiceType.SegmentPriceCard'=>function($q) use($segment_id){
                    $q->addSelect('segment_price_cards.id','segment_price_cards.service_type_id','segment_price_cards.amount','segment_price_cards.price_type','segment_price_cards.driver_id');
                    $q->where('segment_price_cards.segment_id', $segment_id);

                }])
               ->with(['ServiceType.ServiceTranslation'=>function($q) use($merchant_id){
                   $q->addSelect('service_translations.name','service_translations.service_type_id');
                   $q->where('service_translations.merchant_id', $merchant_id);

                }])
               ->with(['DriverGallery'=>function($q) use($segment_id){
                    $q->addSelect('id','driver_id','image_title');
                    $q->where('driver_galleries.segment_id', $segment_id);
                    $q->orWhere('driver_galleries.segment_id', NULL);
                }])
               ->whereHas('ServiceType', function ($q) use ($segment_id) {
                        $q->where('driver_service_type.segment_id', $segment_id);
                    })
                ->where([
                ['drivers.driver_delete', '=', NULL],
                ['drivers.merchant_id', '=', $merchant_id],
                ['drivers.id', '=', $id],
            ])
            ->groupBy('dsr.driver_id')
            ->first();
        return $driver;
    }

    public static function getDeliveryCandidate($arr_reqest)
    {
        $merchant_id = $arr_reqest->merchant_id;
        $segment_id = $arr_reqest->segment_id;
        $latitude = $arr_reqest->latitude;
        $longitude = $arr_reqest->longitude;
        $user_id = $arr_reqest->user_id;
        $order_id = $arr_reqest->id;
        $arr_id = $arr_reqest->arr_id;
        $distance_unit = 1;
        $distance = 500;
        $radius = $distance_unit == 2 ? 3958.756 : 6367;

        $driver = Driver::select('drivers.id','drivers.first_name','drivers.last_name','drivers.profile_image','drivers.created_at','fd.is_favourite')
            ->addSelect(DB::raw('( ' . $radius . ' * acos( cos( radians(' . $latitude . ') ) * cos( radians( current_latitude ) ) * cos( radians( current_longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( current_latitude ) ) ) ) AS distance,drivers.id AS driver_id'))
//            ->addSelect(DB::raw("CAST(AVG (dsr.rating) AS DECIMAL (2,1)) AS rating"),'dsr.driver_id')
//            ->leftJoin('driver_segment_ratings as dsr','drivers.id','=','dsr.driver_id')
            ->leftJoin(DB::raw('(SELECT fd.driver_id, count(fd.driver_id) AS is_favourite FROM `favourite_drivers` as fd where( segment_id="'.$segment_id.'" or segment_id IS NULL AND user_id="'.$user_id.'" or user_id IS NULL) GROUP BY fd.driver_id) fd'),'drivers.id','=','fd.driver_id')
               ->whereHas('ServiceType', function ($q) use ($segment_id) {
                        $q->where('driver_service_type.segment_id', $segment_id);
                    })
                 ->whereHas('Segment', function ($q) use ($segment_id) {
                        $q->where('segment_id', $segment_id);
                    })
                 ->with(['Order'=>function($q){
                   $q->addSelect('driver_id','merchant_order_id','id','order_status');
//                   $q->whereIn('status','');
                 }])
                ->where([
                    ['drivers.merchant_id', '=', $merchant_id],
                    ['drivers.player_id', "!=", NULL],
                    ['login_logout', '=', 1],
                    ['drivers.online_offline', '=', 1],
//                    ['driver_vehicles.vehicle_active_status', '=', 1],
//                    ['driver_driver_vehicle.vehicle_active_status', '=', 1],
                    ['drivers.driver_delete', '=', NULL]
            ])
                 ->where(function($q) use($arr_id){
                     if(!empty($arr_id))
                     {
                         $q->whereIn('id',$arr_id);
                     }
                 })
//                ->whereNOTIn('drivers.id', function ($query) use($order_id){
//                    $query->select('brd.driver_id')
//                        ->from('booking_request_drivers as brd')
//                        ->join('orders as o', 'brd.order_id', '=', 'o.id')
//                        ->where('o.order_status', '=', 1)
//                        ->where(function ($p) use($order_id){
//                            $p->where([['brd.order_id',$order_id],['brd.request_status',3]])->orWhere([['brd.request_status',1]]);
//                        });
//                })
//            ->groupBy('dsr.driver_id')
            ->limit(25)
            ->having('distance', '<', $distance)
            ->orderBy('distance')
            ->get();
//        p($driver);
        return $driver;
    }
}