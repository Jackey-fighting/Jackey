<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;
    protected $table="users";

    public static function boot(){
        parent::boot();
        static::creating(function($user){
            $user->activation_token=str_random(30);
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //获取Gravatar 头像
    public function gravatar($size = '100'){
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash=$size";
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPassword($token));
    }
    //在用户中指明一个用户拥有多条微博
    public function statuses(){//获取跟当前用户id有关的所有statuses表数据
        return $this->hasMany(Status::class);
    }
    //显示主页用户关注的人发布过的微博
    public function feed(){
        return $this->statuses()->orderBy('created_at', 'desc');
    }
}
