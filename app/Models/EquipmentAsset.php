<?php

namespace App\Models;

use App\Traits\Models\{HasImages, HasVideos};
use App\Traits\Models\HasOwnership;
use App\Events\Api\v1\EquipmentAsset\EquipmentAssetOcrScannned;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EquipmentAsset extends Model
{
    use HasImages, HasVideos, HasOwnership;

    protected $fillable = [
        'name',
        'alias',
        'equipment_classification_id',
        'equipment_manufacturer_id',
        'manufacturer',
        'operational_status',
        'regulatory_class',
        'oil_type',
        'classification_other',
        'model',
        'model_year',
        'is_ocr_scanned',
        'serial',
        'manufactured_at',
        'acquired_at',
        'room_area',
        'lng',
        'lat',
        'notes',
        'shutdown_at',
    ];

    protected $with = [
        'classification',
        'circuits',
        'videos',
        'image',
        'images'
    ];

    // protected $hidden = [
    //     'pivot'
    // ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classification()
    {
        return $this->belongsTo(EquipmentAssetClassification::class, 'equipment_classification_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function circuits()
    {
        return $this->hasMany(EquipmentAssetCircuit::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(EquipmentAssetLog::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function sites()
    {
        return $this->morphedByMany(
            Site::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function service_events()
    {
        return $this->morphedByMany(
            ServiceEvent::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function service_event_installs()
    {
        return $this->morphedByMany(
            ServiceEventInstall::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function service_event_leak_inspections()
    {
        return $this->morphedByMany(
            ServiceEventLeakInspection::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function service_event_repairs()
    {
        return $this->morphedByMany(
            ServiceEventRepair::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function service_event_shutdown_mothballs()
    {
        return $this->morphedByMany(
            ServiceEventShutdownMothball::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function service_event_scraps()
    {
        return $this->morphedByMany(
            ServiceEventScrap::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function service_event_gas_charges()
    {
        return $this->morphedByMany(
            ServiceEventGasCharge::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function service_event_gas_recoveries()
    {
        return $this->morphedByMany(
            ServiceEventGasRecovery::class,
            'owner',
            'equipment_asset_owners',
        );
    }

    /**
     * @return void
     */
    static public function boot()
    {
        parent::boot();
        self::updating(function (EquipmentAsset $equipment_asset) {
            if ($equipment_asset->getOriginal('is_ocr_scanned') === 0 && $equipment_asset->is_ocr_scanned === 1) {
                EquipmentAssetOcrScannned::dispatch($equipment_asset);
            }
        });
    }
}
