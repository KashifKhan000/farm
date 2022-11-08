<?php

namespace App\Providers;

use App\Guards\Api\v1\ApiGuard;

use App\Models\Ability;
use App\Models\Account;
use App\Models\Address;
use App\Models\File;
use App\Models\Identity;
use App\Models\Image;
use App\Models\Meta;
use App\Models\PersonalAccessToken;
use App\Models\Privilege;
use App\Models\Profile;
use App\Models\Secret;
use App\Models\User;
use App\Models\Verification;

use App\Models\Badge;
use App\Models\Certification;
use App\Models\Contact;
use App\Models\Company;
use App\Models\CylinderAsset;
use App\Models\CylinderAssetLog;
use App\Models\CylinderAssetManufacturer;
use App\Models\EquipmentAsset;
use App\Models\EquipmentAssetLog;
use App\Models\EquipmentAssetManufacturer;
use App\Models\EquipmentAssetClassification;
use App\Models\Gas;
use App\Models\GasMovement;
use App\Models\GasTransfer;
use App\Models\Goal;
use App\Models\GoalCategory;
use App\Models\RecoveryEquipment;
use App\Models\Site;
use App\Models\ServiceEvent;
use App\Models\ServiceEventInstall;
use App\Models\ServiceEventRepair;
use App\Models\ServiceEventShutdownMothball;
use App\Models\ServiceEventScrap;
use App\Models\ServiceEventLeakInspection;
use App\Models\UserServiceEvent;

use App\Policies\Api\v1\AbilityPolicy;
use App\Policies\Api\v1\AccountPolicy;
use App\Policies\Api\v1\AddressPolicy;
use App\Policies\Api\v1\FilePolicy;
use App\Policies\Api\v1\IdentityPolicy;
use App\Policies\Api\v1\ImagePolicy;
use App\Policies\Api\v1\MetaPolicy;
use App\Policies\Api\v1\PersonalAccessTokenPolicy;
use App\Policies\Api\v1\PrivilegePolicy;
use App\Policies\Api\v1\ProfilePolicy;
use App\Policies\Api\v1\SecretPolicy;
use App\Policies\Api\v1\UserPolicy;
use App\Policies\Api\v1\VerificationPolicy;

use App\Policies\Api\v1\BadgePolicy;
use App\Policies\Api\v1\CertificationPolicy;
use App\Policies\Api\v1\CompanyPolicy;
use App\Policies\Api\v1\ContactPolicy;
use App\Policies\Api\v1\CylinderAssetPolicy;
use App\Policies\Api\v1\CylinderAssetLogPolicy;
use App\Policies\Api\v1\CylinderAssetManufacturerPolicy;
use App\Policies\Api\v1\EquipmentAssetPolicy;
use App\Policies\Api\v1\EquipmentAssetLogPolicy;
use App\Policies\Api\v1\EquipmentAssetManufacturerPolicy;
use App\Policies\Api\v1\EquipmentAssetClassificationPolicy;
use App\Policies\Api\v1\GasPolicy;
use App\Policies\Api\v1\GasMovementPolicy;
use App\Policies\Api\v1\GasTransferPolicy;
use App\Policies\Api\v1\GoalPolicy;
use App\Policies\Api\v1\GoalCategoryPolicy;
use App\Policies\Api\v1\RecoveryEquipmentPolicy;
use App\Policies\Api\v1\SitePolicy;
use App\Policies\Api\v1\ServiceEventPolicy;
use App\Policies\Api\v1\ServiceEventRepairPolicy;
use App\Policies\Api\v1\ServiceEventInstallPolicy;
use App\Policies\Api\v1\ServiceEventShutdownMothballPolicy;
use App\Policies\Api\v1\ServiceEventScrapPolicy;
use App\Policies\Api\v1\ServiceEventLeakInspectionPolicy;
use App\Policies\Api\v1\UserServiceEventPolicy;

use Illuminate\Support\Facades\{ Auth, Gate };
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as BaseAuthServiceProvider;

class AuthServiceProvider extends BaseAuthServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Ability::class => AbilityPolicy::class,
        Account::class => AccountPolicy::class,
        Address::class => AddressPolicy::class,
        File::class => FilePolicy::class,
        Identity::class => IdentityPolicy::class,
        Image::class => ImagePolicy::class,
        Meta::class => MetaPolicy::class,
        Privilege::class => PrivilegePolicy::class,
        Profile::class => ProfilePolicy::class,
        PersonalAccessToken::class => PersonalAccessTokenPolicy::class,
        Secret::class => SecretPolicy::class,
        User::class => UserPolicy::class,
        Verification::class => VerificationPolicy::class,

        Badge::class => BadgePolicy::class,
        Contact::class => ContactPolicy::class,
        Certification::class => CertificationPolicy::class,
        CylinderAsset::class => CylinderAssetPolicy::class,
        CylinderAssetLog::class => CylinderAssetLogPolicy::class,
        CylinderAssetManufacturer::class => CylinderAssetManufacturerPolicy::class,
        EquipmentAsset::class => EquipmentAssetPolicy::class,
        EquipmentAssetLog::class => EquipmentAssetLogPolicy::class,
        EquipmentAssetManufacturer::class => EquipmentAssetManufacturerPolicy::class,
        EquipmentAssetClassification::class => EquipmentAssetClassificationPolicy::class,
        Company::class => CompanyPolicy::class,
        Gas::class => GasPolicy::class,
        GasMovement::class => GasMovementPolicy::class,
        GasTransfer::class => GasTransferPolicy::class,
        Goal::class => GoalPolicy::class,
        GoalCategory::class => GoalCategoryPolicy::class,
        RecoveryEquipment::class => RecoveryEquipmentPolicy::class,
        Site::class => SitePolicy::class,
        ServiceEvent::class => ServiceEventPolicy::class,
        ServiceEventRepair::class => ServiceEventRepairPolicy::class,
        ServiceEventLeakInspection::class => ServiceEventLeakInspectionPolicy::class,
        ServiceEventScrap::class => ServiceEventScrapPolicy::class,
        ServiceEventShutdownMothball::class => ServiceEventShutdownMothballPolicy::class,
        ServiceEventInstall::class => ServiceEventInstallPolicy::class,
        UserServiceEvent::class => UserServiceEventPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }

    /**
     * @return void
     */
    public function register()
    {
        Gate::before(function() {
            return config('croft.permissions.disabled') ?: null;
        });

        Auth::extend('croft', function ($app, $name, array $config) {
            return new ApiGuard(config('sanctum.expiration'));
        });
    }
}
