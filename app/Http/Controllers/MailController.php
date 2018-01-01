<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
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
}
