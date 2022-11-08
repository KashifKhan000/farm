<?php

namespace App\Traits\Requests\Api\v1;

trait HasAddress
{
    /**
     * Get the store validation rules that apply to the request.
     *
     * @return array
     */
    protected function addressStoreRules(string $prefix='')
    {
        return [
            "{$prefix}name" => 'required|string',
            "{$prefix}line1" => 'nullable|string',
            "{$prefix}line2" => 'nullable|string',
            "{$prefix}city" => 'nullable|string',
            "{$prefix}province" => 'required|province:' . request("{$prefix}country"),
            "{$prefix}country" => 'required|string|country',
            "{$prefix}postal_code" => 'nullable|string'
        ];
    }

    /**
     * Get the store validation rules that apply to the request.
     *
     * @return array
     */
    protected function addressUpdateRules(string $prefix='')
    {
        return [
            "{$prefix}name" => 'string',
            "{$prefix}line1" => 'nullable|string',
            "{$prefix}line2" => 'nullable|string',
            "{$prefix}city" => 'nullable|string',
            "{$prefix}province" => 'nullable|string|province:' . request("{$prefix}country"),
            "{$prefix}country" => 'nullable|string|country',
            "{$prefix}postal_code" => 'nullable|string'
        ];
    }
}
