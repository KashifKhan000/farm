<?php

namespace App\Policies\Api\v1;

use App\Models\{ GoalCategory, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class GoalCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any goal_categories.
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
     * Determine whether the user can view the goal_category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GoalCategory  $goal_category
     *
     * @return mixed
     */
    public function show(User $user, GoalCategory $goal_category)
    {
        return true;
    }

    /**
     * Determine whether the user can create goal_categories.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', GoalCategory::class);
    }

    /**
     * Determine whether the user can update the goal_category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GoalCategory  $goal_category
     *
     * @return mixed
     */
    public function update(User $user, GoalCategory $goal_category)
    {
        return $user->hasAbility('update', GoalCategory::class);
    }

    /**
     * Determine whether the user can delete the goal_category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GoalCategory  $goal_category
     *
     * @return mixed
     */
    public function destroy(User $user, GoalCategory $goal_category)
    {
        return $user->hasAbility('destroy', GoalCategory::class);
    }
}
