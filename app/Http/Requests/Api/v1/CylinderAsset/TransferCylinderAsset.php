<?php

namespace App\Http\Requests\Api\v1\CylinderAsset;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\CylinderAsset;

class TransferCylinderAsset extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'cylinder_asset';
        $this->model = CylinderAsset::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required_without:site_id|int|exists:users,id',
            'site_id' => 'required_without:user_id|int|exists:sites,id',
        ];
    }
}
