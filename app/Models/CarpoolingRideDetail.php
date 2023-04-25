<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\CarpoolingTrait;

class CarpoolingRideDetail extends Model
{
    protected $guarded = [];

    public function CarpoolingRide()
    {
        return $this->belongsTo(CarpoolingRide::class);
    }

    public function CarpoolingRideUserDetail()
    {
        return $this->hasMany(CarpoolingRideUserDetail::class);
    }

    public static function searchCarpoolingRides($arr_reqest)
    {
        // query parameters
        $carpooling_ride_id = isset($arr_reqest['carpooling_ride_id']) ? $arr_reqest['carpooling_ride_id'] : NULL;
        $pickup_id = isset($arr_reqest['pickup_id']) ? $arr_reqest['pickup_id'] : NULL;
        $drop_id = isset($arr_reqest['drop_id']) ? $arr_reqest['drop_id'] : NULL;
        $segment_id = isset($arr_reqest['segment_id']) ? $arr_reqest['segment_id'] : NULL;
        $limit = isset($arr_reqest['limit']) ? $arr_reqest['limit'] : 10;
        $country_area_id = isset($arr_reqest['area']) ? $arr_reqest['area'] : null;
        $merchant_id = isset($arr_reqest['merchant_id']) ? $arr_reqest['merchant_id'] : null; 
        $distance_unit = isset($arr_reqest['distance_unit']) ? $arr_reqest['distance_unit'] : '';
        $longitude = isset($arr_reqest['pickup_longitude']) ? $arr_reqest['pickup_longitude'] : null;
        //p($longitude);
        $latitude = isset($arr_reqest['pickup_latitude']) ? $arr_reqest['pickup_latitude'] : null;
       // p($latitude);
        $ac_nonac = isset($arr_reqest['ac_ride']) ? $arr_reqest['ac_ride'] : null;
        $riders_num = isset($arr_reqest['no_of_seats']) ? $arr_reqest['no_of_seats'] : null;
        $distance = isset($arr_reqest['distance']) ? $arr_reqest['distance'] : 4;
        $radius = $distance_unit == 2 ? 3958.756 : 6367;
        $distance_text = $distance_unit == 2 ? "m" : "km";
        $drop_lat = isset($arr_reqest['drop_latitude']) ? $arr_reqest['drop_latitude'] : null;
       // p( $drop_lat);
        $drop_long = isset($arr_reqest['drop_longitude']) ? $arr_reqest['drop_longitude'] : null;
        //p( $drop_long);
        $not_user_id = isset($arr_reqest['not_user_id']) ? $arr_reqest['not_user_id'] : null;
        $user_gender = isset($arr_reqest['user_gender']) ? $arr_reqest['user_gender'] : null;
        //$female_ride = isset($arr_reqest['female_ride']) ? $arr_reqest['female_ride'] : null;
        $payment_type = isset($arr_reqest['payment_type_id']) ? $arr_reqest['payment_type_id'] : null;
        $ride_time = isset($arr_reqest['ride_timestamp']) ? $arr_reqest['ride_timestamp'] : null;
        $before_Time =  $ride_time-86400;
        $after_Time = $ride_time + (86400*2);
        $timeBetween = array($before_Time, $after_Time);
        $currency_symbol = isset($arr_reqest['currency_symbol']) ? $arr_reqest['currency_symbol'] : "UU";

        $query_drop = CarpoolingRideDetail::select("id as drop_id","carpooling_ride_id")
            ->addSelect(DB::raw('( ' . $radius . ' * acos( cos( radians(' . $drop_lat . ') ) * cos( radians( to_latitude ) ) * cos( radians( to_longitude ) - radians(' . $drop_long . ') ) + sin( radians(' . $drop_lat . ') ) * sin( radians( to_latitude ) ) ) ) AS drop_distance'))
            ->with(["CarpoolingRide" => function ($query) use ($carpooling_ride_id, $segment_id, $merchant_id, $not_user_id) {
                if (!empty($carpooling_ride_id)) {
                    $query->where("id", $carpooling_ride_id);
                }
                $query->where('segment_id', $segment_id);
                $query->where('merchant_id', $merchant_id);
                $query->select('id');
                if(!empty($not_user_id)){
                    $query->where("user_id",'!=',$not_user_id);
                }
                $query->where('ride_status', 1);
            }])
            ->whereHas("CarpoolingRide", function ($query) use ($carpooling_ride_id, $segment_id, $merchant_id, $ac_nonac, $not_user_id) {
                if (!empty($carpooling_ride_id)) {
                    $query->where("id", $carpooling_ride_id);
                }
                $query->where('segment_id', $segment_id);
                $query->where('merchant_id', $merchant_id);
                $query->where(function ($query) use ($ac_nonac) {
                    if ($ac_nonac == 1) {
                        $query->where('ac_ride', $ac_nonac);
                    }
                });
                if(!empty($not_user_id)){
                    $query->where("user_id",'!=',$not_user_id);
                }
                $query->select('id');
                $query->where('ride_status', 1);
            });
          //  p( $query_drop);
        if (!empty($drop_id)) {
            $query_drop->where("id", $drop_id);
        }
        $near_by_drops = $query_drop->having('drop_distance', '<', $distance)->orderBy('drop_distance')->get();

        $near_by_drop_ids = $near_by_drops->unique("carpooling_ride_id")->pluck("carpooling_ride_id")->toArray();
        //p($near_by_drop_ids);
      

        // $latitude = "4.064199360271111";
        $query = DB::table("carpooling_ride_details as crd")
            ->select("crd.id as pickup_id", "cr.available_seats", "crd.carpooling_ride_id AS carpooling_ride_id", "cr.user_id", "cr.female_ride", "cr.ac_ride","crd.is_return As return_ride", DB::raw('CONCAT(owner.first_name," ",owner.last_name) AS full_name'), "owner.driver_rating")
            ->addSelect(DB::raw('IFNULL( ( ' . $radius . ' * acos( cos( radians(' . $latitude . ') ) * cos( radians( from_latitude ) ) * cos( radians( from_longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( from_latitude ) ) ) ), 0) AS pickup_distance'))
            //->addSelect("owner.primary_player_id","owner.user_delete","cr.available_seats","owner.country_area_id","uv.id as user_vehicle_id","uv.ac_nonac","uv.vehicle_verification_status")
            ->join('carpooling_rides as cr', 'cr.id', '=', 'crd.carpooling_ride_id')
            ->join('users as owner', 'cr.user_id', '=', 'owner.id')
            ->join('user_vehicles as uv', 'owner.id', '=', 'uv.user_id')
            ->where('cr.segment_id', $segment_id)
            ->where('cr.merchant_id', $merchant_id);
         // ->where('crd.is_return',0);
        //p(   $query);
        $query->where(function ($query) use ($carpooling_ride_id, $pickup_id) {
            if (!empty($carpooling_ride_id)) {
                $query->where("cr.id", $carpooling_ride_id);
            }
            if (!empty($pickup_id)) {
                $query->where("crd.id", $pickup_id);
            }
        });
        

        $query->where([
            //  ['owner.primary_player_id', "!=", NULL],
            ['uv.vehicle_verification_status', '=', 2], // only verified vehicle
            ['owner.user_delete', '=', NULL]
        ])
            ->where(function ($query) use ($ac_nonac) {
                if ($ac_nonac == 1) {
                    return $query->where('cr.ac_ride','=', $ac_nonac);
                }
            })
            // ->where(function ($query) use ($female_ride) {
            //     if ($female_ride == 1) {
            //         return $query->where('cr.female_ride','=',$female_ride);
            //     }
            // })
              ->where(function ($query) use ($payment_type) {
                if ($payment_type == 1) {
                    return $query->where('cr.payment_type','=',$payment_type);
                }
            })
         
            ->where(function ($query) use ($country_area_id) {
                if (!empty($country_area_id)) {
                    //      return $query->where('owner.country_area_id', $country_area_id);
                }
            })
            // ->where(function ($query) use ($ac_nonac, $payment_type) {
            // if ($ac_nonac == 1 || $payment_type == 1) {
            //     $query->where([['cr.ac_ride','=', $ac_nonac],['cr.payment_type','=',$payment_type]]);
            //      }
            //  })
               ->where(function ($query) use ($ac_nonac, $payment_type) {
            if ($ac_nonac == 1 && $payment_type == 1) {
                $query->where([['cr.ac_ride','=', $ac_nonac],['cr.payment_type','=',$payment_type]]);
                 }
             })
        //     ->where(function ($query) use ($ac_nonac, $female_ride) {
        //     if ($ac_nonac == 1 && $female_ride == 1) {
        //         $query->where([['cr.ac_ride','=', $ac_nonac],['cr.female_ride','=',$female_ride]]);
        //     }
        // })
//            ->where("cr.available_seats", ">=", $riders_num)
            ->where(function ($query) use ($riders_num) {
                if (!empty($riders_num)) {
                    $query->where('cr.available_seats', ">=", $riders_num);
                }
            })
            ->where(function ($query) use ($near_by_drop_ids) {
                $query->whereIn('cr.id', $near_by_drop_ids);
            })
           // p($query);
          ->whereBetween("cr.ride_timestamp",$timeBetween )
           //->where("cr.ride_timestamp", '>', $before_Time)
            ->where('cr.ride_status', 1)
            ->having('pickup_distance','<', $distance)
            ->orderBy('pickup_distance')
            ->groupBy('pickup_id')
            ->take($limit);
        $near_by_pickups = $query->get();
        $near_by_drops = $near_by_drops->toArray();
        $near_by_pickups = $near_by_pickups->toArray();
        $near_by_pickups = json_decode(json_encode($near_by_pickups), true);
        foreach ($near_by_pickups as &$near_by_pickup) {
            $key = array_search($near_by_pickup['carpooling_ride_id'], array_column($near_by_drops, 'carpooling_ride_id'));;
            $near_by_pickup['pickup_distance'] = round_number($near_by_pickup['pickup_distance']) . " " . $distance_text;
            $near_by_pickup['drop_distance'] = round_number($near_by_drops[$key]['drop_distance']) . " " . $distance_text;
            $near_by_pickup['drop_id'] = $near_by_drops[$key]['drop_id'];
        }
        $data = [];
        //p($near_by_pickups);
        foreach ($near_by_pickups as &$near_by_pickup) {
            $route = CarpoolingRideDetail::where(function ($query) use ($near_by_pickup) {
                $query->whereBetween('id', [$near_by_pickup['pickup_id'], $near_by_pickup['drop_id']]);
            })->orderBy("drop_no");
            
            $near_by_pickup['total_estimate_distance'] = round_number($route->sum('estimate_distance')) . ' ' . $distance_text;
            $near_by_pickup['total_charges'] = $currency_symbol . ' ' . $route->sum('final_charges')*$riders_num;
            //$near_by_pickup['total_charges'] = $currency_symbol . ' ' . $this->calculateSeatAmount($riders_num,$pickup_id);
            $user = User::find($near_by_pickup['user_id']);
            $route_path = $route->select("drop_no", "from_location", "to_location","estimate_distance_text", "ride_timestamp", "end_timestamp")->get()->toArray();
            //p($route_path);
            $near_by_pickup['profile_image'] = get_image($user->UserProfileImage, 'user', $user->merchant_id);
            $no_drop_points = 0;
            if(!empty($route_path)){
                if (count($route_path) > 1) {
                    $first_point = $route_path[0];
                    $last_point = $route_path[array_key_last($route_path)];
                    //p($last_point);
                    $no_drop_points = count($route_path) - 1;
                    $near_by_pickup['from_location'] = $first_point['from_location'];
                    $near_by_pickup['to_location'] = $last_point['to_location'];
                    $near_by_pickup['start_ride_timestamp'] = $first_point['ride_timestamp'];
                    $near_by_pickup['end_ride_timestamp'] = $last_point['end_timestamp'];
                } else {
                    $first_point = $route_path[0];
                    $near_by_pickup['from_location'] = $first_point['from_location'];
                    $near_by_pickup['to_location'] = $first_point['to_location'];
                    $near_by_pickup['start_ride_timestamp'] = $first_point['ride_timestamp'];
                    $near_by_pickup['end_ride_timestamp'] = $first_point['end_timestamp'];
                }    
            }else{
                $route_path = [];
            }
            $near_by_pickup['route'] = $route_path;
            $near_by_pickup['no_drop_points'] = $no_drop_points;
        
           // p( $near_by_pickup);
            if (!empty($route_path)) {
                array_push($data, $near_by_pickup);
               //return $data;
            }
        }
        if (empty($data)) {
            return [];
        }
        //p($data);
        return $data;
        
    }
       

    public function PriceCard()
    {
        return $this->belongsTo(PriceCard::class, 'price_card_id');
    }
}