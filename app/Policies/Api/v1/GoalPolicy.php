<?php

namespace App\Policies\Api\v1;

use App\Models\{ Goal, User };
use Illuminate\Support\Facades\Log;

use Illuminate\Auth\Access\HandlesAuthorization;

class GoalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any goals.
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
     * Determine whether the user can view the goal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     *
     * @return mixed
     */
    public function show(User $user, Goal $goal)
    {
        if ($user->id === $goal->user_id) {
            return true;
        }
        return $user->hasAbility('show', Goal::class);
    }

    /**
     * Determine whether the user can create goals.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the goal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     *
     * @return mixed
     */
    public function update(User $user, Goal $goal)
    {
        if ($user->id === $goal->user_id) {
            return true;
        }
        return $user->hasAbility('update', Goal::class);
    }

    /**
     * Determine whether the user can delete the goal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Goal  $goal
     *
     * @return mixed
     */
    public function destroy(User $user, Goal $goal)
    {
        if ($user->id === $goal->user_id) {
            return true;
        }
        return $user->hasAbility('destroy', Goal::class);
    }
}
