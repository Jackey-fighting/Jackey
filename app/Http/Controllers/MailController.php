<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\User;
use App\Jobs\SendReminderEmail;

class MailController extends Controller
{
    public function send(){
    	$name = 'JackeyEting_2';

    	$flag = Mail::send('emails.test', compact('name'), function($message){
    		$to = 'jackey_sina@sina.com';
    		$message->to($to)->subject('test email');
    	});
    	
    	if (is_null($flag)) {
    		echo 'Send email successfully.';
    	}else{
    		echo 'Send email fail.';
    	}
    }

    //测试队列发送邮件
    public function emialDspatch(){
        $user = User::first();
        
        SendReminderEmail::dispatch($user)->onQueue('email');
        echo 'you have done.';
    }
}
