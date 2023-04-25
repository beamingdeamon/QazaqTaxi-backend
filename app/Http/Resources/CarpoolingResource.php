<?php

namespace App\Http\Resources;

use App\Models\UserVehicle;
use App\Models\UserDocument;
use App\Models\UserVehicleDocument;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\CountryArea;
use App\Models\Country;
class CarpoolingResource extends JsonResource
{
    public function toArray($data)
    {
        $is_user_doc = false;
        $is_user_offer_ride = false;
        $is_veh_upload = false;
        $is_veh_doc_upload = false;
        $is_user_minimum_balance=false;
        $is_user_minimum_balance_text="";
        $vehicle_list = UserVehicle::whereHas('Users', function ($query) {
            $query->where([['user_id', '=', $this->id], ['user_default_vehicle','=',1]]);
        })->with(['Users' => function ($query) {
            $query->where([['user_id', '=', $this->id], ['user_default_vehicle','=',1]]);
        }])->where(['vehicle_verification_status'=>2])->get();
        //p( $vehicle_list);
        if(count($vehicle_list) > 0){
            $is_user_offer_ride=true;
        }
       
        $upload_vehicle = UserVehicle::whereHas('Users', function ($query) {
            $query->where([['user_id', '=', $this->id], ['user_default_vehicle','=',1]]);
        })->get();
       // p($upload_vehicle);
         if(count($upload_vehicle) > 0){
             $is_veh_upload=true;
        }
         $upload_vehicle_document = UserVehicleDocument::whereHas('UserVehicle', function ($query) {
            $query->where([['user_id', '=', $this->id]]);
        })->get();
       
      // p( $upload_vehicle_document );
         if(count($upload_vehicle_document) > 0){
             $is_veh_doc_upload=true;
        }
         $user_doc = UserDocument::where([['user_id', '=', $this->id]])->get();
         if(count($user_doc) > 0){
              $is_user_doc=true;
        }
        $country=Country::find($this->country_id);
     
        $minimum_balance=CountryArea::where([['country_id','=',$country->id]])->first();
        //p($minimum_balance);
        $user_balance=CountryArea::where([['id', '=', $this->country_area_id]])->first();
        if(empty( $user_balance)){
          $is_user_minimum_balance=false; 
       
        }  
        elseif($this->wallet_balance>=$user_balance->minimum_wallet_amount){
            //p($this);
        $is_user_minimum_balance=true; 

          
        }else{
             $is_user_minimum_balance=false; 
            $is_user_minimum_balance_text="To offer Ride Please Maintain Your Wallet with"." ".$this->Country->isoCode." ".$minimum_balance->minimum_wallet_amount;
        }
        return [
            'is_user_doc_upload'=> $is_user_doc,
            'is_veh_upload'=> $is_veh_upload,
            'is_veh_doc_upload' =>$is_veh_doc_upload,
            'is_user_offer_ride' => $is_user_offer_ride,
            'is_user_minimum_balance'=>$is_user_minimum_balance,
            'offer_ride_text'=>"Your Vehicle-documents are pending for verification",
            'upload_document'=>"Please upload your driver’s documents",
            'upload_vehicle'=>"Please upload your Vehicle",
            'user_doc_upload'=>"Please upload user document",
            'is_user_minimum_balance_text'=>$is_user_minimum_balance_text,
           
        ];
    }
}
