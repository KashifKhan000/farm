<?php

namespace App\Policies\Api\v1;

use App\Models\{ PaymentMethod, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentMethodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any payment_methods.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', PaymentMethod::class);
    }

    /**
     * Determine whether the user can view the payment_method.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaymentMethod  $payment_method
     * 
     * @return mixed
     */
    public function show(User $user, PaymentMethod $payment_method)
    {
        return $user->hasAbility('show', PaymentMethod::class);
    }

    /**
     * Determine whether the user can create payment_methods.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', PaymentMethod::class);
    }

    /**
     * Determine whether the user can update the payment_method.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaymentMethod  $payment_method
     * 
     * @return mixed
     */
    public function update(User $user, PaymentMethod $payment_method)
    {
        return $user->hasAbility('update', PaymentMethod::class);
    }

    /**
     * Determine whether the user can delete the payment_method.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaymentMethod  $payment_method
     * 
     * @return mixed
     */
    public function destroy(User $user, PaymentMethod $payment_method)
    {
        return $user->hasAbility('destroy', PaymentMethod::class);
    }
}
