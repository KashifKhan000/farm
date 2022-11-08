<?php

namespace App\Policies\Api\v1;

use App\Models\{ UserServiceEvent, User };
use Illuminate\Support\Facades\Log;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserServiceEventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user_service_events.
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
        return $user->hasAbility('index', UserServiceEvent::class);
    }

    /**
     * Determine whether the user can view the user_service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserServiceEvent  $user_service_event
     *
     * @return mixed
     */
    public function show(User $user, int $id)
    {
        if ($id === $user->id) {
            return true;
        }
        return $user->hasAbility('show', UserServiceEvent::class);
    }
}
