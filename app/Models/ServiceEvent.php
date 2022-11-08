<?php

namespace App\Models;

use App\Traits\Models\{HasImages, HasVideos, HasAssets};

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class ServiceEvent extends Model
{
    use HasImages, HasVideos, HasAssets, Notifiable;

    protected $fillable = [
        'user_id',
        'site_id',
        'work_order_number',
        'purchase_order_number',
        'external_reference_number',
        'event_description',
        'status',
        'start_at',
        'end_at',
        'contact_name',
        'contact_phone',
        'contact_email',
    ];

    protected $with = [

    ];

    protected $dispatchesEvents = [
        'created',
        'updated',
    ];

    /**
     * Get the user for this service event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the site for this service event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function installs()
    {
        return $this->hasMany(ServiceEventInstall::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leak_inspections()
    {
        return $this->hasMany(ServiceEventLeakInspection::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repairs()
    {
        return $this->hasMany(ServiceEventRepair::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scraps()
    {
        return $this->hasMany(ServiceEventScrap::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shutdown_mothballs()
    {
        return $this->hasMany(ServiceEventShutdownMothball::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gas_charges()
    {
        return $this->hasMany(ServiceEventGasCharge::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gas_recoveries()
    {
        return $this->hasMany(ServiceEventGasRecovery::class);
    }





    /**
     * List of the all of the equipment assets that have been actually serviced in service event details
     * @return Collection
     */
    public function getServicedEquipmentAssetsAttribute()
    {
        $equipmentAssets = collect([]);
        $details = collect([
            $this->installs,
            $this->leak_inspections,
            $this->repairs,
            $this->scraps,
            $this->shutdown_mothballs
        ]);

        $details->flatten()->each(function ($item, $key) use ($equipmentAssets) {
            $item->equipment_asset->with('image');
            $equipmentAssets->push($item->equipment_asset);
        });

        return $equipmentAssets;
    }


    public function scopeDateBetween($query, $startAt, $endAt = null)
    {
        $startDate = Carbon::parse($startAt)->toDateTimeString();
        $endDate = Carbon::parse($endAt)->endOfDay()->toDateTimeString();
        $query->whereRaw("? between start_at and  coalesce(end_at, ?)", [$startDate, $endDate]);
    }
}
