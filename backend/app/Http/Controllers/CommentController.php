<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Comment;
class CommentController extends BaseController
{
    /** 
        添加评论
     */
    public function add(Request $request){
        // $this->isLogin()调用父控制器的方法
        if($this->isLogin()) {
            // 判断用户是否已经在该活动下评论过
             // $hasCommented = count(Comment::where("user_id",session("user_id"))->where("activity_id",$request->actid)->get());     
            $new_comment = new Comment;
            $new_comment->activity_id = $request->actid;
            $new_comment->comment = $request->comment;
            $new_comment->user_id = session("user_id");
            return $new_comment->save()?
                ["status" => 1,"msg" => "create activities succeed"]:
                ["status" => 0,"msg" => "db insert failed"];
            
        } else {
            return ["status" => 0,"msg" => "You need to login first"];
        }
    }

    /** 
        查看评论
     */
    public function read(Request $request){  
        if($actid = $request->actid) {
            $activity = Comment::where("activity_id",$actid)->get();
            return  ["status" => 1,"data" => $activity];
        } else {
            return ["status" => 0,"msg" => "You need to upload activity id"];
        }
    }

}