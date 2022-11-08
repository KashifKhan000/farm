<?php

namespace App\Policies\Api\v1;

use App\Models\{ Leaderboard, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class LeaderboardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any leaderboards.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Leaderboard::class);
    }

    /**
     * Determine whether the user can view the leaderboard.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leaderboard  $leaderboard
     * 
     * @return mixed
     */
    public function show(User $user, Leaderboard $leaderboard)
    {
        return $user->hasAbility('show', Leaderboard::class);
    }

    /**
     * Determine whether the user can create leaderboards.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', Leaderboard::class);
    }

    /**
     * Determine whether the user can update the leaderboard.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leaderboard  $leaderboard
     * 
     * @return mixed
     */
    public function update(User $user, Leaderboard $leaderboard)
    {
        return $user->hasAbility('update', Leaderboard::class);
    }

    /**
     * Determine whether the user can delete the leaderboard.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Leaderboard  $leaderboard
     * 
     * @return mixed
     */
    public function destroy(User $user, Leaderboard $leaderboard)
    {
        return $user->hasAbility('destroy', Leaderboard::class);
    }
}
