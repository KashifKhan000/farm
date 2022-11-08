<?php

namespace App\Policies\Api\v1;

use App\Models\{ Certification, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class CertificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any certifications.
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
     * Determine whether the user can view the certification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Certification  $certification
     *
     * @return mixed
     */
    public function show(User $user, Certification $certification)
    {
        return true;
    }

    /**
     * Determine whether the user can create certifications.
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
     * Determine whether the user can update the certification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Certification  $certification
     *
     * @return mixed
     */
    public function update(User $user, Certification $certification)
    {
        return $user->hasAbility('update', Certification::class);
    }

    /**
     * Determine whether the user can delete the certification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Certification  $certification
     *
     * @return mixed
     */
    public function destroy(User $user, Certification $certification)
    {
        return $user->hasAbility('destroy', Certification::class);
    }

    /**
     * Determine whether the user can delete the service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEvent  $service_event
     *
     * @return mixed
     */
    public function own(User $user, Certification $certification)
    {
        if ($user->id === $certification->user_id) {
            return true;
        }
        return $user->hasAbility('own', Certification::class);
    }
}
