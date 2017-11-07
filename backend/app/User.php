<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // public $table = "user_table";
    // 默认对应users表
    public function signup(){
        return "signup";
    }
};
