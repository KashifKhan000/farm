<?php

namespace App\Policies\Api\v1;

use App\Models\{ ServiceEventGasCharge, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceEventGasChargePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can own the service event repair
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEventGasCharge  $service_event_gas_charge
     *
     * @return mixed
     */
    public function own(User $user, ServiceEventGasCharge $service_event_gas_charge)
    {
        if ($user->id === $service_event_gas_charge->service_event->user_id) {
            return true;
        }
        return $user->hasAbility('own', ServiceEventGasCharge::class);
    }
}
