<?php

namespace App\Traits\Controllers\Api\v1;

use App\Helpers\{ QueryFilterHelper, QueryLimitHelper, QuerySortHelper };

trait HasControllerHelpers
{
    /**
     * @return Model
     */
    protected function loaded($model, string $resource_name, string $ability_name = null)
    {
        $relationships_config = "croft.relationships.$resource_name";
        $attributes_config = "croft.attributes.$resource_name";

        if ($ability_name) {
            $relationships_config .= ".$ability_name";
            $attributes_config .= ".$ability_name";
        }

        return $model->load(config($relationships_config))
                    ->append(config($attributes_config));
    }

    /**
     * @return QueryBuilder
     */
    protected function limited($query, array $fields)
    {
        if (isset($fields['limit'])) {
            $query = QueryLimitHelper::handle($query, $fields['limit']);
        }

        return $query;
    }

    /**
     * @return QueryBuilder
     */
    protected function sorted($query, array $fields)
    {
        if (isset($fields['sort'])) {
            $query = QuerySortHelper::handle($query, $fields['sort']);
        }

        return $query;
    }

    /**
     * @return Collection
     */
    protected function filtered($query, array $fields, string $resource_name = null, string $ability_name = null)
    {
        if (isset($fields['limit'])) {
            $query = QueryLimitHelper::handle($query, $fields['limit']);
        }

        if (isset($fields['sort'])) {
            $query = QuerySortHelper::handle($query, $fields['sort']);
        }

        if (isset($fields['filter'])) {
            $query = QueryFilterHelper::handle($query, $fields['filter']);
        }

        if (is_null($resource_name)) {
            return $query->get();
        }

        $relationships_config = "croft.relationships.$resource_name";
        $attributes_config = "croft.attributes.$resource_name";

        if ($ability_name) {
            $relationships_config .= ".$ability_name";
            $attributes_config .= ".$ability_name";
        }

        return $query->with(config($relationships_config))
                     ->get()
                     ->each->append(config($attributes_config));
    }
}
