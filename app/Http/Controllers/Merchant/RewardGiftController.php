<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Country;
use App\Models\Onesignal;
use App\Models\RewardGift;
use App\Models\UserRedeemedReward;
use App\Models\DriverRedeemedReward;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RewardGiftController extends Controller
{
    use ImageTrait;
    public function index(){
        $data = [];
        $reward_gifts = RewardGift::where([['merchant_id','=',get_merchant_id()],['delete_status','=',NULL]])->orderBy('id','DESC')->paginate(10);
        return view('merchant.reward_gift.index',compact('reward_gifts','data'));
    }

    public function add(Request $request, $id = null){
        $merchant_id = get_merchant_id();
        $reward_gift = null;
        if (!empty($id)){
            $reward_gift = RewardGift::find($id);
        }
        $countries = Country::where([['merchant_id','=',$merchant_id],['country_status','=',1]])->get();
        $rewards = [];
        return view('merchant.reward_gift.form',compact('reward_gift','countries','rewards'));
    }

    public function store(Request $request, $id = null){
        $request->request->add(['id' => $id]);
        $validator = Validator::make($request->all(), [
            'country_id' => 'required_without:id',
            'application' => 'required_without:id',
            'image' => 'required_without:id',
            'reward_points' => 'required',
            'trips' => 'required',
            // 'amount' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return redirect()->back()->with('error',$errors[0])->withInput($request->input());
        }

        $merchant_id = get_merchant_id();
        DB::beginTransaction();
        try {
            if (!empty($id)){
                $reward_gift = RewardGift::find($id);
            }else{
                $reward_gift = new RewardGift();
            }
            if (!empty($request->country_id)){
                $reward_gift->country_id = $request->country_id;
            }
            if (!empty($request->application)){
                $reward_gift->application = $request->application;
            }
            if (!empty($request->image)){
                $reward_gift->image = $this->uploadImage('image','reward_gift',$merchant_id);
            }
            $reward_gift->merchant_id = $merchant_id;
            $reward_gift->name = $request->name;
            $reward_gift->reward_points = $request->reward_points;
            $reward_gift->rides = $request->trips;
            $reward_gift->amount = $request->amount;
            $reward_gift->comment = $request->comment;
            $reward_gift->save();
        }catch (\Exception $e){
            DB::rollBack();
            $msg = $e->getMessage();
            return back()->with('error',$msg);
        }
        DB::commit();
        return back()->with('success',"Reward Gift Data Added Successfully!");
    }

    public function updateStatus($id,$status){
        $reward_gift = RewardGift::find($id);
        $reward_gift->status = $status;
        $reward_gift->save();
        return back()->with('success',"Status Update Successfully!");
    }
    
    public function destroy($id)
    {
        $reward = RewardGift::find($id);
        $reward->delete_status = 1;
        $reward->save();
        return redirect()->back()->with('success', __('admin.deleted.successfully'));
    }
    
    public function UserRedeemedReward(){
        $data = [];
        $reward_gifts = UserRedeemedReward::where('merchant_id',get_merchant_id())->orderBy('id','DESC')->paginate(10);
        // $reward_gifts = RewardGift::where([['merchant_id','=',get_merchant_id()],['delete_status','=',NULL]])->orderBy('id','DESC')->paginate(10);
        return view('merchant.reward_gift.user_redeemed',compact('reward_gifts','data'));
    }
    
    public function UserRedeemedRewardStatus(Request $request)
    {
        $reward = UserRedeemedReward::find($request->reward_id);
        $reward->status = $request->status;
        $reward->notes = $request->notes;
        $reward->save();
        Onesignal::UserPushMessage($reward->user_id, [], 'Reward Close Successfully!!', 909, $reward->merchant_id);
        return redirect()->back()->with('success', "Reward Close Successfully!!");
    }
    
    public function DriverRedeemedReward(){
        $data = [];
        $reward_gifts = DriverRedeemedReward::where('merchant_id',get_merchant_id())->orderBy('id','DESC')->paginate(10);
        // $reward_gifts = RewardGift::where([['merchant_id','=',get_merchant_id()],['delete_status','=',NULL]])->orderBy('id','DESC')->paginate(10);
        return view('merchant.reward_gift.driver_redeemed',compact('reward_gifts','data'));
    }
    
    public function DriverRedeemedRewardStatus(Request $request)
    {
        $reward = DriverRedeemedReward::find($request->reward_id);
        $reward->status = $request->status;
        $reward->notes = $request->notes;
        $reward->save();
        Onesignal::DriverPushMessage($reward->driver_id, [], 'Reward Close Successfully!!', 909, $reward->merchant_id);
        return redirect()->back()->with('success', "Reward Close Successfully!!");
    }
}