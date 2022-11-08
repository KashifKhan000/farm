<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Site\{IndexSite, ShowSite, StoreSite, UpdateSite, DestroySite};
use App\Models\Site;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class SiteController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the sites.
     *
     * @param  \App\Http\Requests\Api\v1\Site\IndexSite  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexSite $request)
    {
        $fields = $request->validated();

        if ($request->get('lat') && $request->get('lng')) {
            $radius = $request->get('radius') ?? 100;
            $lat = $request->get('lat');
            $lng = $request->get('lng');
            $sites = Site::allNearLatlng($lat, $lng, $radius);
            return $sites;
        } else {
            $sites = Site::select();
            return $this->filtered($sites, $fields, 'site', 'index');
        }
    }

    /**
     * Display the specified site.
     *
     * @param  \App\Models\Site  $site
     * @param  \App\Http\Requests\Api\v1\Site\ShowSite  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site, ShowSite $request)
    {
        return $this->loaded($site, 'site', 'show');
    }

    /**
     * Store a newly created site in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Site\StoreSite  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSite $request)
    {
        $fields = $request->validated();

        $site = Site::create($fields)->fresh();

        $site->createAddress($fields['address']);

        return $this->loaded($site->fresh(), 'site', 'store');
    }

    /**
     * Update the specified site in storage.
     *
     * @param  \App\Models\Site  $site
     * @param  \App\Http\Requests\Api\v1\Site\UpdateSite  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Site $site, UpdateSite $request)
    {
        $fields = $request->validated();

        $site->fill($fields);

        $site->save();
        $site->updateOrCreateAddress($fields['address']);

        return $this->loaded($site->fresh(), 'site', 'update');
    }

    /**
     * Remove the specified site from storage.
     *
     * @param  \App\Models\Site  $site
     * @param  \App\Http\Requests\Api\v1\Site\DestroySite  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site, DestroySite $request)
    {
        $site->delete();
        return response()->json(null, 204);
    }
}
