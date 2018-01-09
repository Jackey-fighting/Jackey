<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;
use Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     *执行队列的方法,比如发送邮件
     *
     * @return void
     */
    public function handle()
    {
        $view = 'emails.dispatchEmail';
        $data = ['user'=>$this->user];
        $from = 'jackeyliu@aliyun.com';
        $name = 'Jackey_aliyun';
        $to   = '1193767343@qq.com';
        $subject = "Thanks for you to sign up in the site, please confirm in your email.";

        Mail::send($view, $data, function($message) use($from, $name, $to, $subject){
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }
}
