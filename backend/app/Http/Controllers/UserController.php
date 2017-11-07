<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\Activity;
use Hash;

class UserController extends BaseController
{
    /**
     * 更新指定用户
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $request->flash();
        return $request->old("username");
    }

    /**
        注册api
     */
    public function signup(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // 检测用户名和密码是否为空
        if(!$username || !$password){
            return ["status" => 0,"msg" => "username and password can't be empty"];
        }

        // 检测用户是否存在
        $user_exist = User::where('username', $username)->first();
        if($user_exist){
            return ["status" => 0,"msg" => "user exists"];
        }

        // 加密密码
        $hashed_password = Hash::make($password);

        // dd 函数为 Laravel 内置的打印输出函数
        // dd($hashed_password);

        // 存储用户进数据库
        $new_user = new User;
        $new_user->username = $username;
        $new_user->password = $hashed_password;
        if($new_user->save())
            return ["status" => 1,"msg" => "user " . $new_user->id . " save succeed"];
        else
            return ["status" => 0,"msg" => "db insert failed"];
        
        return 1;
    }

    /** 
        登录api
     */
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        // 检测用户名和密码是否为空
        if(!$username || !$password){
            return ["status" => 0,"msg" => "username and password can't be empty"];
        }

        // 检测用户是否存在
        $user = User::where('username', $username)->first();
        if(!$user)
            return ["status" => 0,"msg" => "user doesn't exist"];
        else{
            $hashed_password = $user->password;
            // 检查明文密码是否与加密后的密码相符
            if (!Hash::check($password, $hashed_password)) 
                return ["status" => 0,"msg" => "password is wrong"];
            else {

                // 写入Session
                $request->session()->put("username",$username);
                $request->session()->put("user_id",$user->id);
                return ["status" => 1,"msg" => "user " . $user->id . " login succeed"];

                // dd(session()->all());
            }
            
        }
    }

    /** 
        注销api
     */
    public function logout(Request $request){
        // dd(session()->all());
       $request->session()->flush();
       return ["status" => 1,"msg" => "loginout succeed"];
    }

    /** 
        查看用户基本信息
     */
    public function detailHome(Request $request){
      $user_id = session("user_id");
      return User::where('id', $user_id)->get();
    }

    /** 
        查看用户参加的活动
     */
    public function detailActivity(Request $request){
      $user_id = session("user_id");
      return Activity::where('user_id', $user_id)->get();
    }

    /** 
        修改基本信息
     */
    public function modifyMessage(Request $request){
      $user_id = session("user_id");
      $user = User::where('id', $user_id)->first(["username"]);
      if($username = $request->username){
         $user->username = $username;
      }
      if($email = $request->email){
         $user->email = $email;
      }
      if($phone = $request->phone){
         $user->phone = $phone;
      }
      if($avatar_url = $request->avatar_url){
         $user->avatar_url = $avatar_url;
      }
      if($intro = $request->intro){
         $user->intro = $intro;
      }

      return $user->save()? 
            ["status" => 1,"msg" => "Modify user basic information succeed"]:
            ["status" => 0,"msg" => "db save failed"]; 
    }

    /** 
        修改密码
     */
    public function modifyPassword(Request $request){
      $user_id = session("user_id");
      $old_psw = $request->old_psw;
      $new_psw = $request->new_psw;
      $user = User::where('id', $user_id)->first();
      if (!Hash::check($old_psw, $user->password))
        return ["status" => 0,"msg" => "old password is wrong"]; 
      else {
        $user->password = $old_psw;
        return $user->save()? 
            ["status" => 1,"msg" => "Modify password succeed"]:
            ["status" => 0,"msg" => "db save failed"]; 
      }
    }



 
}