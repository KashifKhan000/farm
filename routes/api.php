<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\GasTransfer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\AccountController;

// Route::get('userss', [UserController::class, 'usersss']);
Route::post('account/create', [AccountController::class, 'usersss']);
Route::apiResource('accounts', AccountController::class);
Route::apiResource('abilities', AbilityController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('files', FileController::class);
Route::apiResource('images', ImageController::class);
Route::apiResource('privileges', PrivilegeController::class);
Route::apiResource('secrets', SecretController::class)->except('update');
Route::put('secrets', [SecretController::class, 'update']);

Route::apiResource('tokens', TokenController::class)->except('store');
Route::post('tokens/{token}/refresh', [TokenController::class, 'refresh']);

Route::apiResource('verifications', VerificationController::class);
Route::apiResource('videos', VideoController::class);

Route::prefix('users')->name('users.')->group(function () {
  Route::apiResource('{user}/service_events', UserServiceEventController::class)->only(['index', 'show']);
  Route::get('{user}/badges', [BadgeController::class, 'indexUserBadges']);
});
Route::apiResource('users', UserController::class)->except('store');

Route::put('identities/{identity}/verification', [IdentityController::class, 'verify']);
Route::apiResource('identities', IdentityController::class);

Route::apiResource('metas.integers', MetaIntegerController::class);
Route::apiResource('metas.strings', MetaStringController::class);
Route::get('metas/{meta}/entries', [MetaController::class, 'indexEntries']);
Route::post('metas/{meta}/entries', [MetaController::class, 'storeEntries']);
Route::apiResource('metas', MetaController::class);

Route::apiResource('profiles.floats', ProfileFloatController::class);
Route::apiResource('profiles.integers', ProfileIntegerController::class);
Route::apiResource('profiles.strings', ProfileStringController::class);
Route::apiResource('profiles.texts', ProfileTextController::class);
Route::get('profiles/{profile}/entries', [ProfileController::class, 'indexEntries']);
Route::post('profiles/{profile}/entries', [ProfileController::class, 'storeEntries']);
Route::apiResource('profiles', ProfileController::class);

// Route::apiResource('subscriptions', SubscriptionController::class);
Route::apiResource('payment_methods', PaymentMethodController::class)->except('update');
Route::get('setup_intent', [PaymentMethodController::class, 'createSetupIntent']);

Route::put('companies/{company}/user', [CompanyController::class, 'attachUser']);
Route::delete('companies/{company}/user', [CompanyController::class, 'detachUser']);
Route::apiResource('companies', CompanyController::class);

Route::apiResource('badges', BadgeController::class);
Route::apiResource('contacts', ContactController::class);
Route::apiResource('certifications', CertificationController::class);
Route::apiResource('gas', GasController::class);
Route::apiResource('gas_movements', GasMovementController::class);
Route::apiResource('gas_transfers', GasTransferController::class);
Route::apiResource('goals', GoalController::class);
Route::apiResource('goal_categories', GoalCategoryController::class);
Route::get('leaderboard', LeaderboardController::class);
Route::apiResource('recovery_equipment', RecoveryEquipmentController::class);
Route::apiResource('sites', SiteController::class);



Route::name('equipment_assets.')->group(function () {
  Route::apiResource('equipment_assets/manufacturers', EquipmentAssetManufacturerController::class)
    ->parameters(['logs' => 'equipment_asset_log']);
  Route::apiResource('equipment_assets/classifications', EquipmentAssetClassificationController::class)
    ->parameters(['classifications' => 'equipment_asset_classification']);
  Route::apiResource('equipment_assets/logs', EquipmentAssetLogController::class)
    ->parameters(['manufacturers' => 'equipment_asset_manufacturer']);
});
Route::apiResource('equipment_assets/{equipment_asset}/circuits', EquipmentAssetCircuitController::class)
  ->parameters(['circuits' => 'equipment_asset_circuit']);

Route::post('equipment_assets/{equipment_asset}/ocr_nameplate', [EquipmentAssetController::class, 'storeOcrNameplate']);


Route::apiResource('equipment_assets', EquipmentAssetController::class);

Route::name('cylinder_assets.')->group(function () {
  Route::apiResource('cylinder_assets/logs', CylinderAssetLogController::class)
    ->parameters(['logs' => 'cylinder_asset_log']);
  Route::apiResource('cylinder_assets/manufacturers', CylinderAssetManufacturerController::class)
    ->parameters(['manufacturers' => 'cylinder_asset_manufacturer']);
});
Route::post('cylinder_assets/{cylinder_asset}/transfer', [CylinderAssetController::class, 'transfer']);
Route::apiResource('cylinder_assets', CylinderAssetController::class);

Route::apiResource('service_events/{service_event}/installs', ServiceEventInstallController::class)
  ->parameters(['installs' => 'service_event_install']);
Route::apiResource('service_events/{service_event}/leak_inspections', ServiceEventLeakInspectionController::class)
  ->parameters(['leak_inspections' => 'service_event_leak_inspection']);
Route::apiResource('service_events/{service_event}/repairs', ServiceEventRepairController::class)
  ->parameters(['repairs' => 'service_event_repair']);
Route::apiResource('service_events/{service_event}/scraps', ServiceEventScrapController::class)
  ->parameters(['scraps' => 'service_event_scrap']);
Route::apiResource('service_events/{service_event}/shutdown_mothballs', ServiceEventShutdownMothballController::class)
  ->parameters(['shutdown_mothballs' => 'service_event_shutdown_mothball']);
Route::apiResource('service_events/{service_event}/gas_recoveries', ServiceEventGasRecoveryController::class)
  ->parameters(['gas_recoveries' => 'service_event_gas_recovery']);
Route::apiResource('service_events/{service_event}/gas_charges', ServiceEventGasChargeController::class)
  ->parameters(['gas_charges' => 'service_event_gas_charge']);
Route::apiResource('service_events', ServiceEventController::class);
Route::post('service_events/{service_event}/complete', [ServiceEventController::class, 'complete']);
