<?php

namespace App\Policies\Api\v1;

use App\Models\{ ServiceEventInstall, User };

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ServiceEventInstallPolicy
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
    public function own(User $user, ServiceEventInstall $service_event_install)
    {
        if ($user->id === $service_event_install->service_event->user_id) {
            return true;
        }
        return $user->hasAbility('own', ServiceEventInstall::class);
    }
}
