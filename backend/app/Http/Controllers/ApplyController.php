<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User_apply_activity;

class ApplyController extends BaseController
{
    /** 
        报名活动
     */
    public function add(Request $request){
        // $this->isLogin()调用父控制器的方法
        // 检查用户是否登录
        // dd($this->isLogin()["user_id"]);
        if($this->isLogin()) {
             $apply= new User_apply_activity;
             $apply->activity_id = $request->actid;
             $apply->user_id = session("user_id");
             $has_applied = User_apply_activity::where('activity_id', $apply->activity_id)->where("user_id",$apply->user_id)->first();
             if(!$has_applied)
                 return $apply->save()?
                     ["status" => 1,"msg" => "apply activity succeed"]:
                     ["status" => 0,"msg" => "db insert failed"];
             else
                 return ["status" => 0,"msg" => "You have already applied"];
        } else {
            return ["status" => 0,"msg" => "You need to login first"];
        }
    }

    /** 
        取消报名
     */
    public function cancel(Request $request){
        // $this->isLogin()调用父控制器的方法
        // 检查用户是否登录
        // dd($this->isLogin()["user_id"]);
        if($this->isLogin()) {
             $activity_id = $request->actid;
             $user_id = session("user_id");
             // 根据参数id查找对应的活动
             $applied_activity = User_apply_activity::where('activity_id', $activity_id)->where("user_id",$user_id)->first();
             if($applied_activity) {
                return $applied_activity->delete()?
                    ["status" => 1,"msg" => "Activity cancel successfully"]:
                    ["status" => 0,"msg" => "db insert failed"];
             } else {
                return ["status" => 0,"msg" => "could not find the activity"];
             }
        } else {
            return ["status" => 0,"msg" => "You need to login first"];
        }
    }

    public function inquire(Request $request){
        // $this->isLogin()调用父控制器的方法
        // 检查用户是否登录
        // dd($this->isLogin()["user_id"]);
        if($this->isLogin()) {
             $activity_id = $request->actid;
             $user_id = session("user_id");
             // 根据参数id查找对应的活动
             $has_applied = User_apply_activity::where('activity_id', $activity_id)->where("user_id",$user_id)->first();
             if($has_applied) 
                return ["status" => 1,"msg" => "You have applied it"]; 
             else 
                return ["status" => 0,"msg" => "You haven't applied it"];
        } else {
            return ["status" => 0,"msg" => "You need to login first"];
        }
    }

}
