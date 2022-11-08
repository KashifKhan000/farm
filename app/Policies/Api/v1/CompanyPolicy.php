<?php

namespace App\Policies\Api\v1;

use App\Models\{ Company, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any companies.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Company::class);
    }

    /**
     * Determine whether the user can view the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     *
     * @return mixed
     */
    public function show(User $user, Company $company)
    {
        return $user->hasAbility('show', Company::class);
    }

    /**
     * Determine whether the user can create companies.
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
     * Determine whether the user can update the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     *
     * @return mixed
     */
    public function update(User $user, Company $company)
    {
        return $user->hasAbility('update', Company::class);
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     *
     * @return mixed
     */
    public function destroy(User $user, Company $company)
    {
        return $user->hasAbility('destroy', Company::class);
    }

    /**
     * Determine whether the user can attach a company
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company_user
     *
     * @return mixed
     */
    public function attach(User $user, Company $company)
    {
        return true;
    }

    /**
     * Determine whether the user can attach a company
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company_user
     *
     * @return mixed
     */
    public function detach(User $user, Company $company)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEvent  $service_event
     *
     * @return mixed
     */
    public function own(User $user, Company $company)
    {
        if ($user->id === $company->user_id) {
            return true;
        }
        return $user->hasAbility('own', Company::class);
    }
}
