<?php

namespace App\Policies\Api\v1;

use App\Models\{ ServiceEventRepair, User };

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ServiceEventRepairPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can own the service event repair
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEventRepair  $service_event_repair
     *
     * @return mixed
     */
    public function own(User $user, ServiceEventRepair $service_event_repair)
    {
        if ($user->id === $service_event_repair->service_event->user_id) {
            return true;
        }
        return $user->hasAbility('own', ServiceEventRepair::class);
    }
}
