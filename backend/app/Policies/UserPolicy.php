<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
Use App\Activity;

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

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

      //删除活动权限认定
    public function destroy_user(User $user, Activity $activity)
    {
    return $user->is_admin || $activity->user_id === $user->id;
    }
}
