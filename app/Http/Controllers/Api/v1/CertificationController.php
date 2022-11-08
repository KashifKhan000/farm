<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Certification\{ IndexCertification, ShowCertification, StoreCertification, UpdateCertification, DestroyCertification };
use App\Models\Certification;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class CertificationController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the certifications.
     *
     * @param  \App\Http\Requests\Api\v1\Certification\IndexCertification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCertification $request)
    {
        $fields = $request->validated();
        $certifications = Certification::select();

        return $this->filtered($certifications, $fields);
    }

    /**
     * Display the specified certification.
     *
     * @param  \App\Models\Certification  $certification
     * @param  \App\Http\Requests\Api\v1\Certification\ShowCertification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Certification $certification, ShowCertification $request)
    {
        return $certification;
    }

    /**
     * Store a newly created certification in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Certification\StoreCertification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertification $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $request->get('user_id') ?? auth()->id()
        ]);

        return Certification::create($fields)->fresh();
    }

    /**
     * Update the specified certification in storage.
     *
     * @param  \App\Models\Certification  $certification
     * @param  \App\Http\Requests\Api\v1\Certification\UpdateCertification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Certification $certification, UpdateCertification $request)
    {
        $fields = $request->validated();

        $certification->fill($fields);
        $certification->save();

        return $certification;
    }

    /**
     * Remove the specified certification from storage.
     *
     * @param  \App\Models\Certification  $certification
     * @param  \App\Http\Requests\Api\v1\Certification\DestroyCertification  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certification $certification, DestroyCertification $request)
    {
        $certification->delete();
        return response()->json(null, 204);
    }
}
