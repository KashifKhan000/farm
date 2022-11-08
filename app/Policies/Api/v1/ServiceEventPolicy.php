<?php

namespace App\Policies\Api\v1;

use App\Models\{ ServiceEvent, User };

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ServiceEventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any service_events.
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
     * Determine whether the user can view the service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEvent  $service_event
     *
     * @return mixed
     */
    public function show(User $user, ServiceEvent $service_event)
    {
        if ($user->id === $service_event->user_id) {
            return true;
        }
        return $user->hasAbility('show', ServiceEvent::class);
    }

    /**
     * Determine whether the user can create service_events.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEvent  $service_event
     *
     * @return mixed
     */
    public function update(User $user, ServiceEvent $service_event)
    {
        if ($user->id === $service_event->user_id) {
            return true;
        }
        return $user->hasAbility('update', ServiceEvent::class);
    }

    /**
     * Determine whether the user can delete the service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEvent  $service_event
     *
     * @return mixed
     */
    public function destroy(User $user, ServiceEvent $service_event)
    {
        if ($user->id === $service_event->user_id) {
            return true;
        }
        return true;
    }

    /**
     * Determine whether the user can own the service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEvent  $service_event
     *
     * @return mixed
     */
    public function own(User $user, ServiceEvent $service_event)
    {
        if ($user->id === $service_event->user_id) {
            return true;
        }
        return $user->hasAbility('own', ServiceEvent::class);
    }
}
