<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;

class EquipmentAssetCircuit extends Model
{
    protected $fillable = [
        'equipment_asset_id',
        'name',
        'type',
        'charge',
        'notes',
    ];

    protected $appends = [
        'gas_type',
    ];

    protected $with = [
        'gases'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function circuit()
    {
        return $this->belongsTo(EquipmentAsset::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gases()
    {
        return $this->MorphMany(
            AssetGas::class,
            'owner',
        );
    }

    /**
     * Gets the gas type of the first circuit. If only one gas is present, defaults to its name, but if
     * a gas is higher than 80%, it will be named "{GAS TYPE} Mixture". If less, defaults to "Gas Mix"
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getGasTypeAttribute()
    {
        $gases = $this->gases()->get();

        $name = NULL;

        //If there is just one gas, return its name
        if (count($gases) === 1) {
            $name = $gases->first()->gas->name;
        } else if (count($gases) > 1) {
            foreach ($gases as $gas) {
                if ($gas->purity >= 80) {
                    $name = "{$gas->gas_name} Mix";
                }
            }

            if (empty($name)) {
                $name = "Gas Mix";
            }
        }

        return $name;
    }
}
