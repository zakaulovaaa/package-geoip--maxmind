<?php

namespace GeoIp\Models;


use Illuminate\Database\Eloquent\Model;

class Ip extends Model {
    protected $table = 'geo_ip_ipv4';
    protected $primaryKey = 'id';
    protected $attributes = [
        'network' => null,
        'geoname_id' => null,
        'registered_country_geoname_id' => null,
        'represented_country_geoname_id' => null,
        'is_anonymous_proxy' => null,
        'is_satellite_provider' => null,
        'postal_code' => null,
        'latitude' => null,
        'longitude' => null,
        'accuracy_radius' => null,
        'network_from' => null,
        'network_to' => null
    ];
}
