<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\CylinderAsset\{ IndexCylinderAsset, ShowCylinderAsset, StoreCylinderAsset, UpdateCylinderAsset, DestroyCylinderAsset, TransferCylinderAsset };
use App\Models\{CylinderAsset, User};
use App\Traits\Controllers\Api\v1\{HasControllerHelpers, HasAssetFields};

class CylinderAssetController extends Controller
{
    use HasControllerHelpers, HasAssetFields;

    /**
     * Display a listing of the cylinder_assets.
     *
     * @param  \App\Http\Requests\Api\v1\CylinderAsset\IndexCylinderAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCylinderAsset $request)
    {
        $fields = $request->validated();
        $user = auth()->user();
        $cylinder_assets = $user->cylinder_assets()->select();

        return $this->filtered($cylinder_assets, $fields);
    }

    /**
     * Display the specified cylinder_asset.
     *
     * @param  \App\Models\CylinderAsset  $cylinder_asset
     * @param  \App\Http\Requests\Api\v1\CylinderAsset\ShowCylinderAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CylinderAsset $cylinder_asset, ShowCylinderAsset $request)
    {
        return $cylinder_asset;
    }

    /**
     * Store a newly created cylinder_asset in storage.
     *
     * @param  \App\Http\Requests\Api\v1\CylinderAsset\StoreCylinderAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCylinderAsset $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $request->get('user_id') ?? auth()->id(),
        ]);

        $cylinderAsset = CylinderAsset::create($fields);

        $this->attachAssetOwner($fields, $cylinderAsset);

        return $cylinderAsset->fresh();
    }

    /**
     * Update the specified cylinder_asset in storage.
     *
     * @param  \App\Models\CylinderAsset  $cylinder_asset
     * @param  \App\Http\Requests\Api\v1\CylinderAsset\UpdateCylinderAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CylinderAsset $cylinder_asset, UpdateCylinderAsset $request)
    {
        $fields = $request->validated();

        $cylinder_asset->fill($fields);
        $cylinder_asset->save();

        return $cylinder_asset;
    }

    /**
     * Remove the specified cylinder_asset from storage.
     *
     * @param  \App\Models\CylinderAsset  $cylinder_asset
     * @param  \App\Http\Requests\Api\v1\CylinderAsset\DestroyCylinderAsset  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CylinderAsset $cylinder_asset, DestroyCylinderAsset $request)
    {
        $cylinder_asset->delete();
        return response()->json(null, 204);
    }

    public function transfer(CylinderAsset $cylinder_asset, TransferCylinderAsset $request)
    {
        $fields = $request->validated();

        if (!empty($fields['user_id'])) {
            $cylinder_asset->user_id = $fields['user_id'];
            $cylinder_asset->sites()->sync([]);
            $cylinder_asset->save();
            return $cylinder_asset->fresh();
        } else if (!empty($fields['site_id'])) {
            $cylinder_asset->user_id = null;

            $cylinder_asset->save();
            $cylinder_asset->sites()->sync([]);
            $cylinder_asset->sites()->sync($fields['site_id']);
            return $cylinder_asset->fresh();
        }
    }
}
