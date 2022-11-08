<?php

namespace App\Policies\Api\v1;

use App\Models\{ ServiceEventDetail, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceEventDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any service_event_details.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', ServiceEventDetail::class);
    }

    /**
     * Determine whether the user can view the service_event_detail.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEventDetail  $service_event_detail
     * 
     * @return mixed
     */
    public function show(User $user, ServiceEventDetail $service_event_detail)
    {
        return $user->hasAbility('show', ServiceEventDetail::class);
    }

    /**
     * Determine whether the user can create service_event_details.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', ServiceEventDetail::class);
    }

    /**
     * Determine whether the user can update the service_event_detail.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEventDetail  $service_event_detail
     * 
     * @return mixed
     */
    public function update(User $user, ServiceEventDetail $service_event_detail)
    {
        return $user->hasAbility('update', ServiceEventDetail::class);
    }

    /**
     * Determine whether the user can delete the service_event_detail.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEventDetail  $service_event_detail
     * 
     * @return mixed
     */
    public function destroy(User $user, ServiceEventDetail $service_event_detail)
    {
        return $user->hasAbility('destroy', ServiceEventDetail::class);
    }
}
