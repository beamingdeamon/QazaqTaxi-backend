<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Chat;
use App\Models\Onesignal;
use App\Models\UserDevice;
use App\Traits\ApiResponseTrait;
use App\Traits\MerchantTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\BusinessSegment\BusinessSegment;
use App\Models\User;

class ChatController extends Controller
{
    use ApiResponseTrait,MerchantTrait;
    public function UserSendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:bookings,id',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }
        DB::beginTransaction();
        try {
            $booking = Booking::with('Driver')->find($request->booking_id);
            $string_file = $this->getStringFile(NULL,$booking->Merchant);
            $chat = Chat::where([['booking_id', '=', $request->booking_id]])->first();
            $app = array('message' => $request->message, 'sender' => 'USER', 'timestamp' => time(), 'booking_id' => $booking->id, 'driver' => $booking->Driver->fullName, 'username' => $booking->User->UserName);
            if (empty($chat)) {
                $message_array[] = $app;
                $message = json_encode($message_array);
            } else {
                $oldArray = $chat->chat;
                $message = json_decode($oldArray, true);
                $message_array = $app;
                array_push($message, $message_array);
                $message = json_encode($message);
            }
            $chatmessage = Chat::updateOrCreate(
                ['booking_id' => $request->booking_id],
                ['chat' => $message]
            );
            $chatmessage->chat = $app;
            if (!empty($booking->driver_id)) {
                $data = array(
                    'notification_type' => "CHAT",
                    'segment_type' => $booking->Segment->slag,
                    'segment_data' => $chatmessage,
                    'notification_gen_time' => time(),
                );
                $large_icon = get_image($booking->Merchant->BusinessLogo, 'business_logo', $booking->merchant_id, true);
                $title = Str::ucfirst($booking->User->UserName);
                $message = $request->message;
                $arr_param = ['driver_id' => $booking->driver_id, 'data' => $data, 'message' => $message, 'merchant_id' => $booking->merchant_id, 'title' => $title, 'large_icon' => $large_icon];
                Onesignal::DriverPushMessage($arr_param);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        return $this->successResponse(trans("$string_file.success"),$chatmessage);
    }

    public function DriverSendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:bookings,id',
            'message' => 'required|string',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }
        DB::beginTransaction();
        try {
            $booking = Booking::find($request->booking_id);
            $string_file = $this->getStringFile(NULL,$booking->Merchant);
            $chat = Chat::where([['booking_id', '=', $request->booking_id]])->first();
            $app = array('message' => $request->message, 'sender' => 'DRIVER', 'timestamp' => time(), 'booking_id' => $booking->id, 'driver' => $booking->Driver->fullName, 'username' => $booking->User->UserName);
            if (empty($chat)) {
                $message_array[] = $app;
                $message = json_encode($message_array);
            } else {
                $oldArray = $chat->chat;
                $message = json_decode($oldArray, true);
                $message_array = $app;
                array_push($message, $message_array);
                $message = json_encode($message);
            }
            $chatmessage = Chat::updateOrCreate(
                ['booking_id' => $request->booking_id],
                ['chat' => $message]
            );
            $user_id = $booking->user_id;
            $title = "Message of booking #".$booking->merchant_booking_id;
            $data['notification_type'] ="CHAT";
            $data['segment_type'] = $booking->Segment->slag;
            $data['segment_data'] = $app;
            $arr_param = ['user_id'=>$user_id,'data'=>$data,'message'=>'','merchant_id'=>$booking->merchant_id,'title'=>$title,'large_icon'=>''];
            Onesignal::UserPushMessage($arr_param);
//            $arr_param = ['user_id'=>$user_id,'data'=>$app,'message'=>$message,'merchant_id'=>$booking->merchant_id,'title'=>"Driver message",'large_icon'=>""];
//            Onesignal::UserPushMessage($arr_param);
            $chatmessage->chat = $app;
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        return $this->successResponse(trans("$string_file.success"), $chatmessage);
//        return response()->json(['result' => "1", 'message' => trans("$string_file.success"), 'data' => $chatmessage]);
    }

    public function ChatHistory(Request $request)
    {
        // Type is used for driver api version response.
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:bookings,id',
//            'booking_id' => 'required|exists:chats,booking_id',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            if(isset($request->type) && $request->type == 2){
                return $this->failedResponse($errors[0]);
            }else{
                return $this->failedResponse($errors[0]);
            }
        }
        try{
            $string_file = $this->getStringFile($request->merchant_id);
            $chatmessage = Chat::where([['booking_id', '=', $request->booking_id]])->first();
            if(isset($request->type) && $request->type == 2){
                $booking = Booking::find($request->booking_id);
                $data = array(
                    "user_image" => get_image($booking->User->UserProfileImage, 'user', $booking->merchant_id),
                    "user_name" => $booking->User->UserName,
                    "phone" => $booking->User->UserPhone,
                    "status_text" => $booking->booking_status,
                    "booking_id" => $booking->id,
                    "number" => $booking->merchant_booking_id,
                    "chat" => !empty($chatmessage) ? json_decode($chatmessage->chat, true) : []
                );
                return $this->successResponse(trans("$string_file.success"),$data);
            }else{
                if(!empty($chatmessage)){
                    $chatmessage->chat = json_decode($chatmessage->chat, true);
                }
                return response()->json(['result' => "1", 'message' => trans("$string_file.success"), 'data' => $chatmessage]);
            }
        }catch (\Exception $e){
            if(isset($request->type) && $request->type == 2){
                return $this->failedResponse($e->getMessage());
            }else{
                return $this->failedResponse($e->getMessage());
            }
        }
    }

    public function UserSendMessageToStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_segment_id' => 'required|exists:business_segments,id',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }
        DB::beginTransaction();
        try {
            $user = $request->user('api');
            $business_segment = BusinessSegment::find($request->business_segment_id);
            $string_file = $this->getStringFile(NULL,$business_segment->Merchant);
            $chat = Chat::where([['business_segment_id', '=', $request->business_segment_id],['user_id','=',$user->id]])->first();
            $app = array('message' => $request->message, 'sender' => 'USER', 'timestamp' => time(), 'business_segment' => $business_segment->full_name, 'username' => $user->UserName);
            if (empty($chat)) {
                $message_array[] = $app;
                $message = json_encode($message_array);
            } else {
                $oldArray = $chat->chat;
                $message = json_decode($oldArray, true);
                $message_array = $app;
                array_push($message, $message_array);
                $message = json_encode($message);
            }
            $chatmessage = Chat::updateOrCreate(
                ['business_segment_id' => $request->business_segment_id, 'user_id' => $user->id],
                ['chat' => $message,'business_segment_id' => $request->business_segment_id, 'user_id' => $user->id]
            );
            $chatmessage->chat = $app;
            
            $data = array(
                'notification_type' => "CHAT_STORE_USER",
                'segment_type' => $business_segment->Segment->slag,
                'segment_data' => $chatmessage,
                'notification_gen_time' => time(),
            );
            $large_icon = get_image($business_segment->Merchant->BusinessLogo, 'business_logo', $business_segment->merchant_id, true);
            $title = Str::ucfirst($user->UserName);
            $message = $request->message;
            $arr_param = ['business_segment_id' => $business_segment->id, 'data' => $data, 'message' => $message, 'merchant_id' => $business_segment->merchant_id, 'title' => $title, 'large_icon' => $large_icon];
            
            $res = Onesignal::BusinessSegmentPushMessage($arr_param);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        return $this->successResponse(trans("$string_file.success"),$chatmessage);
    }

    public function StoreSendMessageToUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return $this->failedResponse($errors[0]);
        }
        DB::beginTransaction();
        try {
            $business_segment = $request->user('business-segment-api');
            $user = User::find($request->user_id);
            $string_file = $this->getStringFile(NULL,$user->Merchant);
            
            $chat = Chat::where([['business_segment_id', '=', $business_segment->id],['user_id','=',$user->id]])->first();
            
            $app = array('message' => $request->message, 'sender' => 'BUSINESS_SEGMENT', 'timestamp' => time(), 'business_segment' => $business_segment->full_name, 'username' => $user->UserName);
            if (empty($chat)) {
                $message_array[] = $app;
                $message = json_encode($message_array);
            } else {
                $oldArray = $chat->chat;
                $message = json_decode($oldArray, true);
                $message_array = $app;
                array_push($message, $message_array);
                $message = json_encode($message);
            }
            $chatmessage = Chat::updateOrCreate(
                ['business_segment_id' => $business_segment->id, 'user_id' => $user->id],
                ['chat' => $message,'business_segment_id' => $business_segment->id, 'user_id' => $user->id]
            );
           
            $user_id = $user->id;
            $title = Str::ucfirst($business_segment->full_name);
            $data['notification_type'] ="CHAT_STORE_USER";
            $data['segment_type'] = $business_segment->Segment->slag;
            $data['segment_data'] = $app;
            $data['business_segment_id'] = $business_segment->id;
            $arr_param = ['user_id'=>$user->id,'data'=>$data,'message'=>$message,'merchant_id'=>$user->merchant_id,'title'=>$title,'large_icon'=>''];
            $res = Onesignal::UserPushMessage($arr_param);
//            $arr_param = ['user_id'=>$user_id,'data'=>$app,'message'=>$message,'merchant_id'=>$booking->merchant_id,'title'=>"Driver message",'large_icon'=>""];
//            Onesignal::UserPushMessage($arr_param);
            $chatmessage->chat = $app;
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failedResponse($e->getMessage());
        }
        DB::commit();
        return $this->successResponse(trans("$string_file.success"), $chatmessage);
//        return response()->json(['result' => "1", 'message' => trans("$string_file.success"), 'data' => $chatmessage]);
    }
    
    public function ChatHistoryBetweenStoreAndUser(Request $request)
    {
        // Type is used for driver api version response.
        $validator = Validator::make($request->all(), [
            'for' => 'required|in:USER,BUSINESS_SEGMENT',
            'business_segment_id' => 'required_if:for,=,USER',
            'user_id' => 'required_if:for,=,BUSINESS_SEGMENT',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            if(isset($request->type) && $request->type == 2){
                return $this->failedResponse($errors[0]);
            }else{
                return $this->failedResponse($errors[0]);
            }
        }
        try{
            $string_file = $this->getStringFile($request->merchant_id);

            if($request->for=='USER'){
                $user = $request->user('api');
                $business_segment = BusinessSegment::find($request->business_segment_id);
                $chatmessage = Chat::where([['user_id', '=', $user->id],['business_segment_id', '=', $request->business_segment_id]])->first();
                
                $data = array(
                    "user_image" => get_image($business_segment->business_logo, 'business_logo', $business_segment->merchant_id),
                    "user_name" => $business_segment->full_name,
                    "chat" => !empty($chatmessage) ? json_decode($chatmessage->chat, true) : []
                );
            }
            else{
                $business_segment = $request->user('business-segment-api');
                $chatmessage = Chat::where([['user_id', '=', $request->user_id],['business_segment_id', '=', $business_segment->id]])->first();
                $user = User::find($request->user_id);
                $data = array(
                    "user_image" => get_image($user->UserProfileImage, 'user', $user->merchant_id),
                    "user_name" => $user->UserName,
                    "chat" => !empty($chatmessage) ? json_decode($chatmessage->chat, true) : []
                );
            }

            return $this->successResponse(trans("$string_file.success"),$data);
        }catch (\Exception $e){
            if(isset($request->type) && $request->type == 2){
                return $this->failedResponse($e->getMessage());
            }else{
                return $this->failedResponse($e->getMessage());
            }
        }
    }
    
    public function ChatList(Request $request){
        $string_file = $this->getStringFile($request->merchant_id);
        $business_segment = $request->user('business-segment-api');
        $merchant_id = $request->merchant_id;
        $chatList = Chat::where([['business_segment_id', '=', $business_segment->id]])->orderBy('updated_at','DESC')->paginate(25);

        $list = $chatList->map(function ($item) use ( $merchant_id, $string_file) {
                $user = User::find($item->user_id);
                    return [
                        'user_id' =>$user->id,
                        'user_image' =>get_image($user->UserProfileImage, 'user', $user->merchant_id),
                        'user_name' =>$user->UserName
                    ];
                });

        $chatList = $chatList->toArray();
        $next_page_url = isset($chatList['next_page_url']) && !empty($chatList['next_page_url']) ? $chatList['next_page_url'] : "";
        $current_page = isset($chatList['current_page']) && !empty($chatList['current_page']) ? $chatList['current_page'] : 0;

        $response =[
            'current_page'=>$current_page,
            'next_page_url'=>$next_page_url,
            'response_data'=>$list
        ];
        return $this->successResponse(trans("$string_file.success"),$response);
    }
}
