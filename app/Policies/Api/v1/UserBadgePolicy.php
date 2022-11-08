<?php

namespace App\Policies\Api\v1;

use App\Models\{ BadgeUser, User };
use Illuminate\Support\Facades\Log;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserBadgePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user_badges.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function index(User $user, int $id)
    {
        if ($id === $user->id) {
            return true;
        }
        return $user->hasAbility('index', BadgeUser::class);
    }

    /**
     * Determine whether the user can view the user_badge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BadgeUser  $user_badge
     *
     * @return mixed
     */
    public function show(User $user, int $id)
    {
        if ($id === $user->id) {
            return true;
        }
        return $user->hasAbility('show', BadgeUser::class);
    }
}
