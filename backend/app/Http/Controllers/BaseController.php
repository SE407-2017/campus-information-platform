<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    /**
        验证用户是否登录
     */
    public function isLogin(){
        if (session("user_id")){
            return ["username" => session("username"),"user_id" => session("user_id")];
        }
        elseif (session("admin_id")){
            return ["adminname" => session("adminname"),"user_id" => session("admin_id")];
        }
        else
            return 0;
    }
}
