<?php

namespace App\Policies\Api\v1;

use App\Models\{ Badge, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class BadgePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any badges.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the badge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Badge  $badge
     *
     * @return mixed
     */
    public function show(User $user, Badge $badge)
    {
        return true;
    }

    /**
     * Determine whether the user can create badges.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', Badge::class);
    }

    /**
     * Determine whether the user can update the badge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Badge  $badge
     *
     * @return mixed
     */
    public function update(User $user, Badge $badge)
    {
        return $user->hasAbility('update', Badge::class);
    }

    /**
     * Determine whether the user can delete the badge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Badge  $badge
     *
     * @return mixed
     */
    public function destroy(User $user, Badge $badge)
    {
        return $user->hasAbility('destroy', Badge::class);
    }
}
