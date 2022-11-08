<?php

namespace App\Traits\Models;

use App\Models\Address;
use Illuminate\Support\Facades\DB;

trait HasAddresses
{
    /**
     * @param  string  $name
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address(string $name = 'primary')
    {
        return $this->morphOne(Address::class, 'owner')->whereName($name);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'owner');
    }

    /**
     * @return \App\Models\Address
     */
    public function createAddress(array $fields):Address
    {
        return Address::create(
            array_merge($fields,
                [ 'name' => $fields['name'],
                  'owner_id' => $this->id,
                  'owner_type' => self::class ])
        );
    }

    /**
     * @return \App\Models\Address|bool
     */
    public function updateOrCreateAddress(array $fields)
    {
        $predicate = [
            'name' => $fields['name'],
            'owner_id' => $this->id,
            'owner_type' => self::class ];

        $address = Address::where($predicate)->first();

        if ($address) {
            return $address->fill($fields)->save();
        }

        return $this->createAddress($fields);
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    /**
     * Retrieves all addresses within a certain radius of the latitude and longitutde
     *
     * @param mixed $lat
     * @param mixed $lng
     * @param int $radius
     * @param float $distance_unit
     * @param int $limit
     * @return array
     */
    static public function allNearLatlng($lat, $lng, $radius = 200, $distance_unit = 111.045, $limit = 15)
    {
        $tableName = self::getTableName();

        $query = DB::raw("
            SELECT *
            FROM (
            SELECT t.name AS name,
				a.line1,
				a.line2,
				a.city,
				a.province,
				a.country,
				a.owner_type,
				a.lat,
				a.lng,
                p.radius,
                p.distance_unit
                    * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(p.latpoint))
                    * COS(RADIANS(a.lat))
                    * COS(RADIANS(p.longpoint - a.lng))
                    + SIN(RADIANS(p.latpoint))
                    * SIN(RADIANS(a.lat))))) AS distance
            FROM addresses AS a
            JOIN $tableName t on t.id = a.owner_id
            JOIN (   /* these are the query parameters */
                    SELECT  :lat  AS latpoint,  :lng AS longpoint,
                            :radius AS radius,      :distance_unit AS distance_unit
                ) AS p ON 1=1
            WHERE a.owner_type = :owner_type
            AND a.lat
                BETWEEN p.latpoint  - (p.radius / p.distance_unit)
                    AND p.latpoint  + (p.radius / p.distance_unit)
            AND a.lng
                BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
                    AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
            ) AS d

            WHERE distance <= radius
            ORDER BY distance
            LIMIT :limit
        ");

        return DB::select($query, [
            "owner_type" => __CLASS__,
            "lat" => $lat,
            "lng" => $lng,
            "radius" => $radius,
            "distance_unit" => $distance_unit,
            "limit" => $limit
        ]);
    }
}
