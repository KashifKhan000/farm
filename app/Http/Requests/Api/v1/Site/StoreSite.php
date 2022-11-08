<?php

namespace App\Http\Requests\Api\v1\Site;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\{HasOwnership, HasAddress};
use App\Models\Site;

class StoreSite extends ApiRequest
{
    use HasOwnership, HasAddress;

    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Site::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return array_merge([
            'name' => 'required|string'
        ], $this->addressStoreRules("address."));
    }
}
