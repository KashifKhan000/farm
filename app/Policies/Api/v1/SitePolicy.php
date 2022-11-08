<?php

namespace App\Policies\Api\v1;

use App\Models\{ Site, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sites.
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
     * Determine whether the user can view the site.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Site  $site
     *
     * @return mixed
     */
    public function show(User $user, Site $site)
    {
        return true;
    }

    /**
     * Determine whether the user can create sites.
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
     * Determine whether the user can update the site.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Site  $site
     *
     * @return mixed
     */
    public function update(User $user, Site $site)
    {
        if ($site->owner) {
            if ($user->id === $site->owner->id) {
                return true;
            } else if ($user->can('update', $site->owner)) {
                return true;
            }
        }

        return $user->hasAbility('update', Site::class);
    }

    /**
     * Determine whether the user can delete the site.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Site  $site
     *
     * @return mixed
     */
    public function destroy(User $user, Site $site)
    {
        if ($site->owner) {
            if ($user->id === $site->owner->id) {
                return true;
            } else if ($user->can('destroy', $site->owner)) {
                return true;
            }
        }

        return $user->hasAbility('destroy', Site::class);
    }

    /**
     * Determine whether the user can own the site
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Site  $site
     *
     * @return mixed
     */
    public function own(User $user, Site $site)
    {
        return true;
    }
}
