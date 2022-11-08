<?php

namespace App\Policies\Api\v1;

use App\Models\{ServiceEventGasRecovery, User};

use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceEventGasRecoveryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can own the service event repair
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEventGasRecovery  $service_event_gas_recovery
     *
     * @return mixed
     */
    public function own(User $user, ServiceEventGasRecovery $service_event_gas_recovery)
    {
        if ($user->id === $service_event_gas_recovery->service_event->user_id) {
            return true;
        }
        return $user->hasAbility('own', ServiceEventGasRecovery::class);
    }
}
