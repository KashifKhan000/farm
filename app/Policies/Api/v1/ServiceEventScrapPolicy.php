<?php

namespace App\Policies\Api\v1;

use App\Models\{ ServiceEventScrap, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceEventScrapPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can own the service event repair
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEventScrap  $service_event_scrap
     *
     * @return mixed
     */
    public function own(User $user, ServiceEventScrap $service_event_scrap)
    {
        if ($user->id === $service_event_scrap->service_event->user_id) {
            return true;
        }
        return $user->hasAbility('own', ServiceEventScrap::class);
    }
}
