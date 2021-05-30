<?php

namespace GeoIp\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpv4Table extends Migration
{
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('geo_ip_ipv4', function (Blueprint $table) {
            $table->increments('id');
            $table->string('network')->nullable();
            $table->string('geoname_id')->nullable();
            $table->string('registered_country_geoname_id')->nullable();
            $table->string('represented_country_geoname_id')->nullable();
            $table->string('is_anonymous_proxy')->nullable();
            $table->string('is_satellite_provider')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('accuracy_radius')->nullable();
            $table->string('network_from')->nullable();
            $table->string('network_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('geo_ip_ipv4');
    }
}
