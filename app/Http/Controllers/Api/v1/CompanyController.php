<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Company\{ IndexCompany, ShowCompany, StoreCompany, UpdateCompany, DestroyCompany, AttachCompanyUser, DetachCompanyUser };
use App\Http\Requests\Api\v1\CompanyUser\AttachCompanyUser as CompanyUserAttachCompanyUser;
use App\Models\{Company, User};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class CompanyController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the companies.
     *
     * @param  \App\Http\Requests\Api\v1\Company\IndexCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCompany $request)
    {
        $fields = $request->validated();
        $companies = Company::select();

        return $this->filtered($companies, $fields);
    }

    /**
     * Display the specified company.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Http\Requests\Api\v1\Company\ShowCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, ShowCompany $request)
    {
        return $company;
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Company\StoreCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $request->get('user_id') ?? auth()->id(),
        ]);

        $company = Company::create($fields);

        $company->createAddress($fields['address']);

        return $company->fresh();
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Http\Requests\Api\v1\Company\UpdateCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company, UpdateCompany $request)
    {
        $fields = $request->validated();

        $company->fill($fields);
        $company->save();

        $company->updateOrCreateAddress($fields['address']);

        return $company->fresh();
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Http\Requests\Api\v1\Company\DestroyCompany  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, DestroyCompany $request)
    {
        $company->delete();
        return response()->json(null, 204);
    }

    /**
     * Attach a company to a user
     *
     * @param  \App\Http\Requests\Api\v1\Company\AttachCompanyUser  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function attachUser(Company $company, AttachCompanyUser $request)
    {
        $fields = $request->validated();
        $company->users()->syncWithoutDetaching($fields['user_id']);

        return response()->json(null, 204);
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Company\DetachCompanyUser  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function detachUser(Company $company, DetachCompanyUser $request)
    {
        $fields = $request->validated();
        $company->users()->detach($fields['user_id']);

        return response()->json(null, 204);
    }
}
