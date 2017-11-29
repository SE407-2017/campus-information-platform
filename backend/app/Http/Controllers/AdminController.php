<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Admin;
use Hash;
use App\Activity;

class AdminController extends BaseController
{
  /**
      注册api
   */
  public function signup(Request $request)
  {
      $adminname = $request->adminname;
      $password = $request->password;

      // 检测管理员名和密码是否为空
      if(!$adminname || !$password){
          return ["status" => 0,"msg" => "adminname and password can't be empty"];
      }

      // 检测管理员是否存在
      $admin_exist = Admin::where('adminname', $adminname)->first();
      if($admin_exist){
          return ["status" => 0,"msg" => "admin exists"];
      }

      // 加密密码
      $hashed_password = Hash::make($password);

      // dd 函数为 Laravel 内置的打印输出函数
      // dd($hashed_password);

      // 存储管理员进数据库
      $new_admin = new Admin;
      $new_admin->adminname = $adminname;
      $new_admin->password = $hashed_password;
      if($new_admin->save())
          return ["status" => 1,"msg" => "admin " . $new_admin->id . " save succeed"];
      else
          return ["status" => 0,"msg" => "db insert failed"];

      return 1;
  }

  public function login(Request $request){
      $adminname = $request->adminname;
      $password = $request->password;

      // 检测管理员名和密码是否为空
      if(!$adminname || !$password){
          return ["status" => 0,"msg" => "adminname and password can't be empty"];
      }

      // 检测管理员是否存在
      $admin = Admin::where('adminname', $adminname)->first();
      if(!$admin)
          return ["status" => 0,"msg" => "admin doesn't exist"];
      else if (session("adminname")){
          return ["status" => 0, "msg" => "you have already logged in !"];
      }
      else{
          $hashed_password = $admin->password;
          // 检查明文密码是否与加密后的密码相符
          if (!Hash::check($password, $hashed_password))
              return ["status" => 0,"msg" => "password is wrong"];
          else {
              // 写入Session
              $request->session()->put("adminname",$adminname);
              $request->session()->put("admin_id",$admin->id);
              return ["status" => 1,"msg" => "admin " . $admin->id . " login succeed","adminname" => $adminname];

              // dd(session()->all());
          }
      }
  }

  public function logout(Request $request){
      // dd(session()->all());
     $request->session()->flush();
     return ["status" => 1,"msg" => "loginout succeed"];
  }
  /**
      修改密码
   */
  public function modifyPassword(Request $request){
    $admin_id = session("admin_id");
    $old_psw = $request->old_psw;
    $new_psw = $request->new_psw;
    $admin = Admin::where('id', $admin_id)->first();
    if (!Hash::check($old_psw, $admin->password))
      return ["status" => 0,"msg" => "old password is wrong"];
    else {
      $user->password = $old_psw;
      return $user->save()?
          ["status" => 1,"msg" => "Modify password succeed"]:
          ["status" => 0,"msg" => "db save failed"];
    }
  }

  public function hide(Request $request){
      if($this->adminIsLogin()){
        $activity_id = $request->id;
        $activity = Activity::find($activity_id);
        //隐藏活动
        if ($activity){
          $activity->isShow = false;
          return ["status" => 1,"msg" => "Activity ".$activity_id." is hidden"];
        }
        else{
          return ["status" => 0,"msg"=>"No such activity"];
        }
      }
      else{
        return ["status"=>0, "msg"=>"you have to login first."];
      }
  }

}
