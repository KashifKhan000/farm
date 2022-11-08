<?php

namespace App\Policies\Api\v1;

use App\Models\{ GasTransfer, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class GasTransferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any gas_transfers.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', GasTransfer::class);
    }

    /**
     * Determine whether the user can view the gas_transfer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GasTransfer  $gas_transfer
     *
     * @return mixed
     */
    public function show(User $user, GasTransfer $gas_transfer)
    {
        if ($gas_transfer->owner) {
            if ($user->id === $gas_transfer->owner->service_event->user_id) {
                return true;
            } else if ($user->can('show', $gas_transfer->owner)) {
                return true;
            }
        }

        return $user->hasAbility('show', GasTransfer::class);
    }

    /**
     * Determine whether the user can delete the gas_transfer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GasTransfer  $gas_transfer
     *
     * @return mixed
     */
    public function destroy(User $user, GasTransfer $gas_transfer)
    {
        if ($gas_transfer->owner) {
            if ($user->id === $gas_transfer->owner->service_event->user_id) {
                return true;
            } else if ($user->can('destroy', $gas_transfer->owner)) {
                return true;
            }
        }

        return $user->hasAbility('destroy', GasTransfer::class);
    }
}
