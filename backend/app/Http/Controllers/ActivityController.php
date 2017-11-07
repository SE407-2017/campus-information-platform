<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Activity;
class ActivityController extends BaseController
{
    /** 
        发布活动
     */
    public function add(Request $request){
        // $this->isLogin()调用父控制器的方法
        // 检查用户是否登录
        if($this->isLogin()) {
             $new_activity = new Activity;
             $new_activity->title = $request->title;
             $new_activity->desc = $request->desc;
             $new_activity->user_id = session("user_id");
             return $new_activity->save()?
                 ["status" => 1,"msg" => "create activities succeed"]:
                 ["status" => 0,"msg" => "db insert failed"];
        } else {
            return ["status" => 0,"msg" => "You need to login first"];
        }
    }

    /** 
        更新活动
     */
    public function update(Request $request){
        if($this->isLogin()) {
            $id = $request->id;
            // 根据参数id查找对应的活动
            $activity = Activity::find($id);

            // 检查活动是否存在
            if(!$activity)
                return ["status" => 0,"msg" => "Activity not exists"];

            // 检查该活动的创建用户是否与当前用户一致，否则无权限更新
            if($activity->user_id == session("user_id")){
                if($request->title)
                    $activity->title = $request->title;
                if($request->desc)
                    $activity->desc = $request->desc;
                return $activity->save()?
                    ["status" => 1,"msg" => "Modify succeed"]:
                    ["status" => 0,"msg" => "db insert failed"];;
            }
            else{
                return ["status" => 0,"msg" => "You don't have the access to modify this question"];
            }
        } else {
            return ["status" => 0,"msg" => "You need to login first"];
        }
    }

    /** 
        查看活动
     */
    public function read(Request $request){
        // 根据传上来的查询参数id返回对应活动
        if($id = $request->id){
            $activity = Activity::find($id);
            if($activity)
                return  ["status" => 1,"data" => $activity];
            else
                return ["status" => 0,"msg" =>"No that activity"];
        } else {
            // 根据参数page显示页面
            if( $page = $request->page)
                return ["status" => 1,"data" => Activity::take(10)->skip(($page-1)*10)->get()];
            else
                return ["status" => 1,"data" => Activity::take(10)->get()];
        }

    }

     /** 
        删除活动
     */
    public function remove(Request $request){
        if($this->isLogin()) {
            $id = $request->id;
            if (!$id)
                return ["status" => 0,"msg" => "Id is needed"];
            // 根据参数id查找对应的活动
            $activity = Activity::find($id);

            // 检查活动是否存在
            if(!$activity)
                return ["status" => 0,"msg" => "Activity not exists"];

            // 检查该活动的创建用户是否与当前用户一致，否则无权限删除
            if($activity->user_id == session("user_id")){
                return $activity->delete()?
                    ["status" => 1,"msg" => "Remove succeed"]:
                    ["status" => 0,"msg" => "db insert failed"];;
            }
            else{
                return ["status" => 0,"msg" => "You don't have the access to delete this question"];
            }
        } else {
            return ["status" => 0,"msg" => "You need to login first"];
        }

    }
}