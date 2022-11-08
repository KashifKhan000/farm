<?php

namespace App\Listeners\Api\v1\Token;

use App\Traits\Observers\Api\v1\Badges\HasAppUsageBadges;
use App\Events\Api\v1\Token\TokenCreated;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class HandleTokenCreation
{
    use HasAppUsageBadges;

    public $user;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Handles the token being created. Creates an entry in the app_usages table if this is the first login of the day
     *
     * @param  TokenCreated  $event
     * @return void
     */
    public function handle(TokenCreated $event)
    {

        if ($event->accessToken->tokenable_type === config('croft.models.namespace') . "User") {
            $user = User::find($event->accessToken->tokenable_id);

            if ($user->app_usages()->whereDate('created_at', DB::raw('CURDATE()'))->exists() === false) {
                $user->app_usages()->create();
                $this->handleBadges($user);
            }
        }
    }
}
