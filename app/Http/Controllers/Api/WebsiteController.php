<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Helper\PolygenController;
use App\Models\CountryArea;
use App\Models\WebsiteFeaturesComponents;
use App\Models\WebSiteHomePage;
use App\Models\WebsiteApplicationFeature;
use App\Models\WebsiteFeature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Application;
use App\Traits\MerchantTrait;

class WebsiteController extends Controller
{

    use MerchantTrait;
    public function cars(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return response()->json(['result' => "0", 'message' => $errors[0], 'data' => []]);
        }
        $merchant_id = $request->merchant_id;
        $area = PolygenController::Area($request->latitude, $request->longitude, $merchant_id);
        if (empty($area)) {
            return response()->json(['result' => "0", 'message' => trans("$string_file.no_service_area"), 'data' => []]);
        }
        $area_id = $area['id'];
        $areas = CountryArea::with('ServiceTypes')->find($area_id);
        $currency = $areas->Country->isoCode;
        $newHomeScreen = new HomeController();
        $areas = $newHomeScreen->ServiceType($areas, $areas->Merchant, $request);
        return response()->json(['result' => "1", 'message' => "cars", 'currency' => $currency, 'data' => $areas]);
    }

    // segment home screen data
    public function segmentHomeScreen(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'segment_id' => 'required|string',
            'calling_type' => 'required|in:ALLINONE,SINGLE', //semgent types
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return response()->json(['result' => "0", 'message' => $errors[0], 'data' => []]);
        }

        //p($request->merchant_id);
        $merchant_id = $request->merchant_id;
        $string_file = $this->getStringFile($merchant_id);
        $checkData = WebSiteHomePage::where([['merchant_id', '=', $merchant_id]])->first();
        //p($checkData);

        // p($website_feature);
        if (!empty($checkData->id))
        {

            $return = [];
            $application = Application::where([['merchant_id', '=', $merchant_id]])->first();

            $logo = ""; $title = ""; $bg_color_primary = "";$bg_color_secondary = ""; $text_color_primary = ""; $text_color_secondary = "";
            $detail_content = [];
            $service_content = [];
            $driver_android_link="";
            $driver_ios_link="";
            $user_android_link="";
            $user_ios_link ="";
            if($request->calling_type == "SINGLE")
            {
                $website_feature = $checkData->WebsiteFeature;
                $banner_text =  !empty($website_feature->Banner) ? json_decode($website_feature->Banner,true) :[];
                $banner_data['logo'] = get_image($checkData->user_banner_image,'website_images',$merchant_id);
                $banner_data = array_merge($banner_data,$banner_text);

                $logo = get_image( $checkData->logo , 'website_images' , $merchant_id);
                $title =!empty($website_feature->Title) ? $website_feature->Title : "";
                $bg_color_primary = $checkData->bg_color_primary;
                $bg_color_secondary = $checkData->bg_color_secondary;
                $text_color_primary = $checkData->text_color_primary;
                $text_color_secondary = $checkData->text_color_secondary;
                $detail_content = !empty($website_feature->FooterLeft) ? json_decode($website_feature->FooterLeft,true) :[];
                $service_content = !empty($website_feature->FooterRight) ? json_decode($website_feature->FooterRight,true) :[];

                $driver_android_link=isset($application->android_driver_link) ? $application->android_driver_link :'';
                $driver_ios_link=isset($application->ios_driver_link) ? $application->ios_driver_link :'';
                $user_android_link=isset($application->user_android_link) ? $application->user_android_link :'';
                $user_ios_link=isset($application->user_ios_link) ? $application->user_ios_link :'';
            }
            else
            {
                $banner_component =  WebsiteFeaturesComponents::where([['segment_id','=',$request->segment_id],['web_site_home_page_id','=',$checkData->id]])->first();
                $banner_data['logo'] = get_image($banner_component->banner_image,'website_images',$merchant_id);
                $banner_data['title'] = $banner_component->FeatureTitle;
                $banner_data['description'] =$banner_component->FeatureDescription;
            }

            $return =[
                'header'=>[
                    'logo'=>$logo,
                    'title'=>$title,
                ],
                'footer'=>[
                    'logo'=>$logo,
                    'title'=>$title,
                ],
                'banner'=>$banner_data, // banner data of segment
                'app_theme'=>[
                    'bg_color_primary'=>$bg_color_primary,
                    'bg_color_secondary'=>$bg_color_secondary,
                    'text_color_primary'=>$text_color_primary,
                    'text_color_secondary'=>$text_color_secondary,
                ],
                'content'=>[
                    'detail_content'=>$detail_content,
                    'service_content'=>$service_content,
                ],
                'social_links'=>[
                    'driver_android_link'=>$driver_android_link,
                    'driver_ios_link'=>$driver_ios_link,
                    'user_android_link'=>$user_android_link,
                    'user_ios_link'=>$user_ios_link,
                ],
            ];
        }
        else
        {

            return response()->json(['result' => "0", 'message' => trans("$string_file.data_not_found"), 'data' => []]);
        }


        // $data['bg_color'] = $checkData->footer_bgcolor;
        // $data['text_color'] = $checkData->footer_text_color;
        // $data['driver_android_Link'] = '';
        // $data['driver_ios_Link'] = '';

        // $application = Application::where([['merchant_id', '=', $request->merchant_id]])->first();
        // if(!empty($application->id))
        // {
        //     $data['driver_android_Link'] = isset($application->android_driver_link) ? $application->android_driver_link :'';
        //     $data['driver_ios_Link'] = isset($application->ios_driver_link) ? $application->ios_driver_link :'';
        // }
        return response()->json(['result' => "1", 'message' => trans("$string_file.success"), 'data' => $return]);
    }


    // AllInOne home screen data
    public function HomeScreen(Request $request)
    {
        //p($request->merchant_id);
        $merchant_id = $request->merchant_id;
        $string_file = $this->getStringFile($merchant_id);
        $checkData = WebSiteHomePage::where([['merchant_id', '=', $merchant_id]])->first();
        //p($checkData);

        // p($website_feature);
        if (!empty($checkData->id))
        {

            $return = [];
            $website_feature = $checkData->WebsiteFeature;
            $banner_text =  !empty($website_feature->Banner) ? json_decode($website_feature->Banner,true) :[];
            $banner_data['logo'] = get_image($checkData->user_banner_image,'website_images',$merchant_id);
            $banner_data = array_merge($banner_data,$banner_text);
            $application = Application::where([['merchant_id', '=', $merchant_id]])->first();
            //p($application);
            $return =[
                'header'=>[
                    'logo'=>get_image( $checkData->logo , 'website_images' , $merchant_id),
                    'title'=>!empty($website_feature->Title) ? $website_feature->Title : "",
                ],
                'footer'=>[
                    'logo'=>get_image( $checkData->logo , 'website_images' , $merchant_id),
                    'title'=>!empty($website_feature->Title) ? $website_feature->Title : "",
                ],
                'banner'=>$banner_data, // banner data for all in one screen
                'app_theme'=>[
                    'bg_color_primary'=>$checkData->bg_color_primary,
                    'bg_color_secondary'=>$checkData->bg_color_secondary,
                    'text_color_primary'=>$checkData->text_color_primary,
                    'text_color_secondary'=>$checkData->text_color_secondary,
                ],
                'content'=>[
                    'detail_content'=>!empty($website_feature->FooterLeft) ? json_decode($website_feature->FooterLeft,true) :[],
                    'service_content'=>!empty($website_feature->FooterRight) ? json_decode($website_feature->FooterRight,true) :[],
                ],
                'social_links'=>[
                    'driver_android_link'=>isset($application->android_driver_link) ? $application->android_driver_link :'',
                    'driver_ios_link'=>isset($application->ios_driver_link) ? $application->ios_driver_link :'',
                    'user_android_link'=>isset($application->user_android_link) ? $application->user_android_link :'',
                    'user_ios_link'=>isset($application->user_ios_link) ? $application->user_ios_link :'',
                ],
            ];
        }
        else
        {

            return response()->json(['result' => "0", 'message' => trans("$string_file.data_not_found"), 'data' => []]);
        }


        // $data['bg_color'] = $checkData->footer_bgcolor;
        // $data['text_color'] = $checkData->footer_text_color;
        // $data['driver_android_Link'] = '';
        // $data['driver_ios_Link'] = '';

        // $application = Application::where([['merchant_id', '=', $request->merchant_id]])->first();
        // if(!empty($application->id))
        // {
        //     $data['driver_android_Link'] = isset($application->android_driver_link) ? $application->android_driver_link :'';
        //     $data['driver_ios_Link'] = isset($application->ios_driver_link) ? $application->ios_driver_link :'';
        // }
        return response()->json(['result' => "1", 'message' => trans("$string_file.success"), 'data' => $return]);
    }

    public function DriverHomeScreen(Request $request)
    {
        $checkData = WebSiteHomePage::where([['merchant_id', '=', $request->merchant_id]])->first();
        if (empty($checkData)) {
            return response()->json(['result' => "0", 'message' => trans("$string_file.data_not_found"), 'data' => []]);
        }
        $data = $this->Driver($checkData, $request->merchant_id);
        return response()->json(['result' => "1", 'message' => trans('api.homeScreen'), 'data' => $data]);
    }

    public function User(WebSiteHomePage $checkData, $merchant_id)
    {
        $logo = $checkData->Merchant->WebsiteHomePage ? $checkData->Merchant->WebSiteHomePage->logo : '';
        return [
            'app_logo' => get_image( $logo , 'website_images' , $merchant_id),
            'footer_logo' => get_image( $logo , 'website_images' , $merchant_id),
            //'user_login_bg_image' => get_image($checkData->user_login_bg_image , 'website_images' , $merchant_id),
            // 'estimate_container' => $this->estimate_container($checkData),
            // 'book_form_config' => $this->BookingConfig($checkData),
            'banner_image' => get_image($checkData->user_banner_image,'website_images',$merchant_id),
            // 'feature_board_data' => $this->features($merchant_id, 'USER'),
            // 'features_component' => $this->Application($merchant_id, 'USER'),
            // 'featured_component_main_image' => get_image($checkData->featured_component_main_image , 'website_images' , $merchant_id),
            // 'user_estimate_image' => get_image($checkData->user_estimate_image , 'website_images' , $merchant_id),
            'user_ios_link' => $checkData->Merchant->WebSiteHomePage ? $checkData->Merchant->WebSiteHomePage->ios_link : "",
            'user_android_link' => $checkData->Merchant->WebSiteHomePage ? $checkData->Merchant->WebSiteHomePage->android_link : "",
            'footer_content' => "In order to help you create your app, we offer you a Whitelabel app. We provide complete re-skinning to make it your app.",
            'banner_content' => "In order to help you create your app, we offer you a Whitelabel app. We provide complete re-skinning to make it your app.",
            // 'footer' => $this->Footer($checkData)
        ];
    }

    public function Driver(WebSiteHomePage $checkData, $merchant_id)
    {
        return [
            'header' => $this->DriverHeader($checkData),
            'driver_login_bg_image' => get_image($checkData->driver_login_bg_image , 'website_images' , $merchant_id),
            'features' => $this->features($merchant_id, 'DRIVER'),
            'how_app_works' => $this->DriverApplication($merchant_id, 'DRIVER'),
            'footer' => $this->Footer($checkData),
        ];
    }

    public function Footer($checkData)
    {
        return [
            // "image" => get_image($checkData->driver_footer_image , 'website_images' , $checkData->merchant_id),
            // "heading" => $checkData->FooterHeading,
            // "subHeading" => $checkData->FooterSubHeading,
            "bg_color" => $checkData->footer_bgcolor,
            "text_color" => $checkData->footer_text_color
        ];
    }

    public function DriverHeader($checkData)
    {
        return [
            "id" => 1,
            "image" => get_image($checkData->driver_banner_image , 'website_images' , $checkData->merchant_id),
            "heading" => $checkData->DriverHeading,
            "subHeading" => $checkData->subHeading,
            "buttonText" => $checkData->driverButtonText
        ];
    }

    public function estimate_container($checkData)
    {
        return [
            "start_address_hint" => $checkData->StartAddress,
            "end_address_hint" => $checkData->EndAddress,
            "book_btn_title" => $checkData->EstimateButton,
            "description" => $checkData->EstimateDescription,
        ];
    }

    public function BookingConfig($checkData)
    {
        return [
            "start_address_hint" => $checkData->StartAddress,
            "end_address_hint" => $checkData->EndAddress,
            "book_btn_title" => $checkData->BookingButton
        ];
    }

    public function features($merchant_id, $application)
    {
        $features = [];
        $websiteFeature = WebsiteFeature::where([['application', '=', $application], ['merchant_id', '=', $merchant_id]])->get();
        if (!empty($websiteFeature->toArray())) {
            foreach ($websiteFeature as $value) {
                $features[] = [
                    "id" => $value->id,
                    "title" => $value->FeatureTitle,
                    "iconUrl" => $value->feature_image,
                    "description" => $value->FeatureDiscription
                ];
            }
        }
        return $features;
    }

    public function Application($merchant_id, $application)
    {
        $features = [];
        $websiteFeature = WebsiteFeaturesComponents::where([['application', '=', $application], ['merchant_id', '=', $merchant_id]])->get();
        if (!empty($websiteFeature->toArray())) {
            foreach ($websiteFeature as $value) {
                $features[] = [
                    "id" => $value->id,
                    "title" => $value->FeatureTitle,
                    "image" => get_image($value->feature_image , 'website_images' , $merchant_id),
                    "description" => $value->FeatureDiscription,
                    'align' => $value->align
                ];
            }
        }
        return $features;
    }

    public function DriverApplication($merchant_id, $application)
    {
        $features = [];
        $websiteFeature = WebsiteApplicationFeature::where([['application', '=', $application], ['merchant_id', '=', $merchant_id]])->get();
        if (!empty($websiteFeature->toArray())) {
            foreach ($websiteFeature as $value) {
                $features[] = [
                    "id" => $value->id,
                    "title" => $value->FeatureTitle,
                    "image" => get_image($value->image , 'website_images' , $merchant_id),
                    "description" => $value->FeatureDiscription,
                    'align' => $value->align
                ];
            }
        }
        return $features;
    }


}
