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
        if (session("user_id"))
            return session("user_id");
        else
            return 0;
    }
}