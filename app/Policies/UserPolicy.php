<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //生成一个update()
    public function update(User $currentUser, User $user){//第一个参数是默认是当前的登录的用户id
        return $currentUser->id === $user->id;
    }

    //删除用户的授权策略
    public function destroy(User $currentUser,User $user){
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
  
}
