<?php
namespace GeoIp\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('geo_ip_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('geoname_id'); //по этому id связь с таблицей ip
            $table->string('locale_code')->nullable();
            $table->string('continent_code')->nullable();
            $table->string('continent_name')->nullable();
            $table->string('country_iso_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('subdivision_1_iso_code')->nullable();
            $table->string('subdivision_1_name')->nullable();
            $table->string('subdivision_2_iso_code')->nullable();
            $table->string('subdivision_2_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('metro_code')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('is_in_european_union')->nullable();
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
        Schema::dropIfExists('geo_ip_cities');
    }
}
