<?php

namespace App\Policies\Api\v1;

use App\Models\{ Contact, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user_contacts.
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
     * Determine whether the user can view the user_contact.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $user_contact
     *
     * @return mixed
     */
    public function show(User $user, Contact $user_contact)
    {
        if ($user->id === $user_contact->user_id) {
            return true;
        }
        return $user->hasAbility('show', Contact::class);
    }

    /**
     * Determine whether the user can create user_contacts.
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
     * Determine whether the user can update the user_contact.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $user_contact
     *
     * @return mixed
     */
    public function update(User $user, Contact $user_contact)
    {
        if ($user->id === $user_contact->user_id) {
            return true;
        }
        return $user->hasAbility('update', Contact::class);
    }

    /**
     * Determine whether the user can delete the user_contact.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contact  $user_contact
     *
     * @return mixed
     */
    public function destroy(User $user, Contact $user_contact)
    {
        if ($user->id === $user_contact->user_id) {
            return true;
        }
        return $user->hasAbility('destroy', Contact::class);
    }
}
