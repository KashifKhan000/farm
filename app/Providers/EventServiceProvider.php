<?php

namespace App\Providers;

use App\Events\Api\v1\Identity\{ IdentityCreated, IdentityVerified };
use App\Events\Api\v1\Recovery\RecoveryCreated;
use App\Events\Api\v1\User\UserIdentified;
use App\Events\Api\v1\Verification\VerificationCreated;
use App\Events\Api\v1\Token\TokenCreated;

use App\Events\Api\v1\EquipmentAssets\EquipmentAssetOcrScannned;

use App\Listeners\Api\v1\Identity\{ CheckForFirstTimeVerify, CreateIdentityVerification, SendVerifyIdentityNotification };
use App\Listeners\Api\v1\Recovery\SendVerifyRecoveryNotification;
use App\Listeners\Api\v1\User\SendWelcomeUserNotification;

use App\Listeners\Api\v1\EquipmentAsset\CheckEquipmentAssetOcrScan;

use App\Models\
{
    Identity,
    PersonalAccessToken,
    Recovery,
    User,

    ServiceEvent,
};
use App\Observers\Api\v1\
{
    IdentityObserver,
    PersonalAccessTokenObserver,
    RecoveryObserver,
    UserObserver,

    ServiceEventObserver,
};

use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // IdentityCreated::class => [
        //     CreateIdentityVerification::class
        // ],

        // IdentityVerified::class => [
        //     CheckForFirstTimeVerify::class
        // ],

        // RecoveryCreated::class => [
        //     SendVerifyRecoveryNotification::class
        // ],

        // UserIdentified::class => [
        //     SendWelcomeUserNotification::class
        // ],

        // VerificationCreated::class => [
        //     SendVerifyIdentityNotification::class
        // ],


        // EquipmentAssetOcrScannned::class => [
        //     CheckEquipmentAssetOcrScan::class
        // ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Identity::observe(IdentityObserver::class);
        // PersonalAccessToken::observe(PersonalAccessTokenObserver::class);
        Recovery::observe(RecoveryObserver::class);
        User::observe(UserObserver::class);

        ServiceEvent::observe(ServiceEventObserver::class);
    }

    public function shouldDiscoverEvents()
    {
        return true;
    }
}
