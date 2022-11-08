<?php

namespace App\Policies\Api\v1;

use App\Models\{ServiceEventLeakInspection, User};

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ServiceEventLeakInspectionPolicy
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
    public function own(User $user, ServiceEventLeakInspection $service_event_leak_inspection)
    {
        if ($user->id === $service_event_leak_inspection->service_event->user_id) {
            return true;
        }
        return $user->hasAbility('own', ServiceEventLeakInspection::class);
    }
}
