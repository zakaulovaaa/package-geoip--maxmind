<?php

namespace GeoIp\Models;


use Illuminate\Database\Eloquent\Model;

class City extends Model {
    protected $table = 'geo_ip_cities';
    protected $primaryKey = 'id';
    protected $attributes = [
        'locale_code' => null,
        'continent_code' => null,
        'continent_name' => null,
        'country_iso_code' => null,
        'country_name' => null,
        'subdivision_1_iso_code' => null,
        'subdivision_1_name' => null,
        'subdivision_2_iso_code' => null,
        'subdivision_2_name' => null,
        'city_name' => null,
        'metro_code' => null,
        'time_zone' => null,
        'is_in_european_union' => null,
    ];
}
