<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Admin;
use Hash;
use App\Activity;

class AdminController extends BaseController
{
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
              return ["status" => 1,"msg" => "user " . $user->id . " login succeed","username" => $username];

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
