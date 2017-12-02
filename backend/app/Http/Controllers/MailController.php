<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Http\Requests;
use Mail;
class MailController extends Controller
{
    public function send(Request $request)
  {
     $email = $request->email;
     $username = session("username");
     $name = '学院君';

     $flag = Mail::send('emails.reminder',['username'=>$username,"activity"=>Activity::take(4)->get()],function($message) use ($email){
            $to = $email;
            $message ->to($to)->subject('New activities ! Come and join us');
     });
     if($flag){
        echo '发送邮件成功，请查收！';
     } else{
        echo '发送邮件失败，请重试！';
    }
  }

}
