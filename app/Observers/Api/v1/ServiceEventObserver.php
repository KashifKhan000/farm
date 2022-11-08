<?php

namespace App\Observers\Api\v1;

use App\Models\ServiceEvent;
use Illuminate\Support\Facades\Log;
use App\Traits\Observers\Api\v1\Badges\HasServiceEventBadges;


class ServiceEventObserver
{
    use HasServiceEventBadges;

    /**
     * Handle the ServiceEvent "created" event.
     *
     * @param  \App\Models\ServiceEvent  $serviceEvent
     * @return void
     */
    public function created(ServiceEvent $serviceEvent)
    {
        $this->handleBadges($serviceEvent);
    }

    /**
     * Handle the ServiceEvent "updated" event.
     *
     * @param  \App\Models\ServiceEvent  $serviceEvent
     * @return void
     */
    public function updated(ServiceEvent $serviceEvent)
    {
        $this->handleBadges($serviceEvent);
    }

    /**
     * Handle the ServiceEvent "deleted" event.
     *
     * @param  \App\Models\ServiceEvent  $serviceEvent
     * @return void
     */
    public function deleted(ServiceEvent $serviceEvent)
    {
        //
    }

    /**
     * Handle the ServiceEvent "restored" event.
     *
     * @param  \App\Models\ServiceEvent  $serviceEvent
     * @return void
     */
    public function restored(ServiceEvent $serviceEvent)
    {
        //
    }

    /**
     * Handle the ServiceEvent "force deleted" event.
     *
     * @param  \App\Models\ServiceEvent  $serviceEvent
     * @return void
     */
    public function forceDeleted(ServiceEvent $serviceEvent)
    {
        //
    }
}
