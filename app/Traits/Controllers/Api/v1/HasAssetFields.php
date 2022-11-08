<?php

namespace App\Traits\Controllers\Api\v1;

use App\Helpers\QueryFilterHelper;
use Illuminate\Support\Str;
use App\Models\{EquipmentAsset, CylinderAsset, ServiceEvent, Site};
use Illuminate\Support\Facades\Log;

trait HasAssetFields
{
    /**
     * @return Model
     */
    protected function attachAssets($resource, $fields, $name)
    {
        if (!empty($fields["{$name}_assets"])) {
            foreach ($fields["{$name}_assets"] as $key => $assetFields) {
                /**
                 * Attach to both the service event as well as the service event's site
                 */

                $model = Str::start(ucfirst($name) . 'Asset', config('croft.models.namespace'));
                $relationship = Str::snake((new \ReflectionClass(get_class($resource)))->getShortName() . 's');

                $asset = $model::firstOrCreate($assetFields)->fresh();
                $asset->$relationship()->syncWithoutDetaching($resource->id);

                /**
                 * If the relationship is 'serviceEvent', use its site_id. Otherwise use its parent service event's site_id
                 */
                if (get_class($resource) === Str::start('ServiceEvent', config('croft.models.namespace'))) {
                    $asset->sites()->syncWithoutDetaching($resource->site_id);
                } else {
                    $asset->sites()->syncWithoutDetaching($resource->serviceEvents->site_id);
                }
            }
        }
    }

    protected function attachAssetOwner( $fields, $asset)
    {
        if (!empty($fields['owner_type']) && !empty($fields['owner_id'])) {
            switch ($fields['owner_type']) {
                case 'Site':
                    $asset->sites()->sync([]);
                    $asset->sites()->sync($fields['owner_id']);
                    break;

                case 'ServiceEvent':
                    $asset->service_events()->syncWithoutDetaching($fields['owner_id']);
                    $serviceEventSiteId = ServiceEvent::find($fields['owner_id'])->site_id;
                    $asset->sites()->syncWithoutDetaching($serviceEventSiteId);
                    break;
                case 'ServiceEventInstall':
                    $asset->service_event_installs()->syncWithoutDetaching($fields['owner_id']);
                    break;

                case 'ServiceEventLeakInspection':
                    $asset->service_event_leak_inspections()->syncWithoutDetaching($fields['owner_id']);
                    break;

                case 'ServiceEventRepair':
                    $asset->service_event_repairs()->syncWithoutDetaching($fields['owner_id']);
                    break;

                case 'ServiceEventShutdownMothball':
                    $asset->service_event_shutdown_mothballs()->syncWithoutDetaching($fields['owner_id']);
                    break;
                case 'ServiceEventGasCharge':
                    $asset->service_event_gas_charges()->syncWithoutDetaching($fields['owner_id']);
                    break;
                case 'ServiceEventGasRecovery':
                    $asset->service_event_gas_recoveries()->syncWithoutDetaching($fields['owner_id']);
                    break;


                default:
                    break;
            }
        }
    }

    protected function gasRecoveryAmountExceeded($fields)
    {
        /** Ensure that the amount of gas recovered does not exceed the amount deposited  */
        if (!empty($fields['gas_recoveries_from']) && !empty($fields['gas_recoveries_to'])) {
            $gas_recovered_from = 0;
            foreach ($fields['gas_recoveries_from'] as $gas_recovery_from) {
                $gas_recovered_from += $gas_recovery_from['gas_quantity'];
            }

            $gas_recovered_to = 0;
            foreach ($fields['gas_recoveries_to'] as $gas_recovery_to) {
                $gas_recovered_to += $gas_recovery_to['gas_quantity'];
            }

            if ($gas_recovered_to > $gas_recovered_from) {
                return true;
            }
        }
    }

    protected function addGasRecoveriesFrom($service_event_gas_recovery, $fields, $gas_transfer)
    {
        if (!empty($fields['equipment_asset_id'])) {    //Gas recovery from single equipment asset
            EquipmentAsset::find($fields['equipment_asset_id'])->circuits()->findOrFail($fields['equipment_asset_circuit_id']);
            $service_event_gas_recovery->equipment_assets()->syncWithoutDetaching($fields['equipment_asset_id']);
        }

        if (!empty($fields['gas_recoveries_from'])) {
            foreach ($fields['gas_recoveries_from'] as $gas_recovery_from) {
                if (!empty($gas_recovery_from['from_equipment_asset_id'])) {  //Gas recovery from likely multiple equipment assets in bulk recovery
                    $equipment_asset = EquipmentAsset::find($gas_recovery_from['from_equipment_asset_id'])->circuits()->findOrFail($gas_recovery_from['from_equipment_asset_circuit_id']);
                    $service_event_gas_recovery->equipment_assets()->syncWithoutDetaching($gas_recovery_from['from_equipment_asset_id']);
                }

                $gas_movement_from = $gas_transfer->gas_movements()->create([
                    'from_equipment_asset_circuit_id' => $gas_recovery_from['from_equipment_asset_circuit_id'] ?? null,
                    'from_cylinder_asset_id' => $gas_recovery_from['from_cylinder_asset_id'] ?? null
                ]);

                $gas_movement_from->gas_quantity = $gas_recovery_from['gas_quantity'];
                $gas_movement_from->save();

                if (!empty($gas_recovery_from['from_cylinder_asset_id'])) {
                    $service_event_gas_recovery->cylinder_assets()->syncWithoutDetaching($gas_recovery_from['from_cylinder_asset_id']);
                }
            }
        }
    }


    protected function addGasRecoveriesTo($service_event_gas_recovery, $fields, $gas_transfer)
    {
        if (!empty($fields['gas_recoveries_to'])) {
            foreach ($fields['gas_recoveries_to'] as $gas_recovery_to) {
                $gas_movement = $gas_transfer->gas_movements()->create([
                    'from_equipment_asset_circuit_id' => $fields['to_equipment_asset_id'] ?? null,
                    'to_cylinder_asset_id' => $gas_recovery_to['to_cylinder_asset_id'] ?? null
                ]);

                $gas_movement->gas_quantity = $gas_recovery_to['gas_quantity'];
                $gas_movement->save();

                if (!empty($gas_recovery_from['to_cylinder_asset_id'])) {
                    $service_event_gas_recovery->cylinder_assets()->syncWithoutDetaching($gas_recovery_to['to_cylinder_asset_id']);
                }
            }
        }
    }

    protected function addGasRecoveries($service_event_gas_recovery, $fields, $gas_transfer)
    {
        $this->addGasRecoveriesFrom($service_event_gas_recovery, $fields, $gas_transfer);
        $this->addGasRecoveriesTo($service_event_gas_recovery, $fields, $gas_transfer);

    }

    protected function addGasCharges($service_event_gas_charge, $fields, $gas_transfer)
    {
        if (!empty($fields['gas_charges'])) {
            foreach ($fields['gas_charges'] as $gas_charge) {
                EquipmentAsset::find($service_event_gas_charge->equipment_asset_id)->circuits()->findOrFail($gas_charge['to_equipment_asset_circuit_id']);
                $gas_movement = $gas_transfer->gas_movements()->firstOrNew([
                    'from_cylinder_asset_id' => $gas_charge['from_cylinder_asset_id'],
                    'to_equipment_asset_circuit_id' => $gas_charge['to_equipment_asset_circuit_id']
                ]);

                $gas_movement->gas_quantity = $gas_charge['gas_quantity'];
                $gas_movement->save();

                $service_event_gas_charge->equipment_assets()->syncWithoutDetaching($gas_charge['from_cylinder_asset_id']);
                $service_event_gas_charge->cylinder_assets()->syncWithoutDetaching($fields['equipment_asset_id']);
            }
        }
    }
}
