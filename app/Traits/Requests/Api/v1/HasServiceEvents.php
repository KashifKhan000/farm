<?php

namespace App\Traits\Requests\Api\v1;

trait HasServiceEvents
{
    /**
     * Get the store validation rules that apply to the request.
     *
     * @return array
     */
    protected function serviceEventStoreRules()
    {
        return [
            'user_id' => 'sometimes|required|int|exists:users,id|is_or_can:store,ServiceEvent',
            'site_id' => 'required|int|exists:sites,id',
            'work_order_number' => 'nullable|string',
            'purchase_order_number' => 'nullable|string',
            'external_reference_number' => 'nullable|string',
            'event_description' => 'required|string|min:10',
            'status' => 'required|in:Upcoming,In Progress,Completed',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after:start_at',
            'contact_name' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|string',
        ];
    }

    /**
     * Get the update validation rules that apply to the request.
     *
     * @return array
     */
    protected function serviceEventUpdateRules()
    {
        return [
            'user_id' => 'int|exists:users,id|is_or_can:update,ServiceEvent',
            'site_id' => 'int|exists:sites,id',
            'work_order_number' => 'nullable|string',
            'purchase_order_number' => 'nullable|string',
            'external_reference_number' => 'nullable|string',
            'event_description' => 'string|min:10',
            'status' => 'in:Upcoming,In Progress,Completed',
            'start_at' => 'date',
            'end_at' => 'nullable|date|after:start_at',
            'contact_name' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|string',
        ];
    }

    /**
     * Get the store validation rules that apply to the request.
     *
     * @return array
     */
    protected function serviceEventInstallStoreRules()
    {
        return [
            'user_id' => 'sometimes|required|int|exists:users,id|is_or_can:store,ServiceEvent',
            'site_id' => 'required|int|exists:sites,id',
            'work_order_number' => 'nullable|string',
            'purchase_order_number' => 'nullable|string',
            'external_reference_number' => 'nullable|string',
            'event_description' => 'required|string|min:10',
            'status' => 'required|in:Upcoming,In Progress,Completed',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at'
        ];
    }

}
