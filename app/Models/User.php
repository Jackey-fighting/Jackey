<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Auth;
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
   
    //查出多个粉丝
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
    //获取用户关注人列表
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
    //关注用户
    public function follow($user_ids){
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
         $this->followings()->sync($user_ids, false);
    }
    //取消关注
    public function unfollow($user_ids){
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }
    //判断用户a是否关注了用户b
    public function isFollowing($user_id){
      return  $this->followings->contains($user_id);
    }
    //显示主页用户关注的人发布过的微博
    //加入动态数据
    public function feed(){
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);
        return Status::whereIn('user_id', $user_ids)
                                ->with('user')
                                ->orderBy('created_at', 'desc');
    }

}
