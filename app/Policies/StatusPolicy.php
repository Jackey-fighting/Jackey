<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Status;

class StatusPolicy
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
    //删除权限，用用户的id 和 要删除的微博user_id进行判断，如果是同个用户的则可以删除
    public function destroy(User $user, Status $status){
        return $user->id === $status->user_id;
    }
}
