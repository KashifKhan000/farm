<?php

namespace App\Listeners\Api\v1\User;

use App\Events\Api\v1\User\UserCreated;
use App\Models\Profile;

class CreateNewUserPrimaryProfile
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\User\UserCreated  $event
     *
     * @return void
     */
    public function handle(UserCreated $event)
    {
      $event->user->profiles()->updateOrCreate(
        ['name' => 'primary']
      );
    }
}
