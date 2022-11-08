<?php

namespace App\Policies\Api\v1;

use App\Models\{ServiceEventShutdownMothball, User};

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ServiceEventShutdownMothballPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEvent  $service_event
     *
     * @return mixed
     */
    public function own(User $user, ServiceEventShutdownMothball $service_event_shutdown_mothball)
    {
        if ($user->id === $service_event_shutdown_mothball->service_event->user_id) {
            return true;
        }
        return $user->hasAbility('own', ServiceEventShutdownMothball::class);
    }
}
