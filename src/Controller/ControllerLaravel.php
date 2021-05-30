<?php

namespace GeoIp\Controller;


use GeoIp\DTO\CityDTO;
use GeoIp\DTO\IpDTO;
use GeoIp\Models\Ip;
use GeoIp\Models\City;
use GeoIp\Migrations\CreateCitiesTable;
use GeoIp\Migrations\CreateIpv4Table;

class ControllerLaravel implements \GeoIp\ControllerInterfaces\DataProvider
{

    public function createTableCity(): void
    {
        $table = new CreateCitiesTable();
        $table->down();
        $table->up();
    }

    public function deleteTableCity(): void
    {
        $table = new CreateCitiesTable();
        $table->down();
    }

    public function createTableIp(): void
    {
        $table = new CreateIpv4Table();
        $table->down();
        $table->up();
    }

    public function deleteTableIp(): void
    {
        $table = new CreateIpv4Table();
        $table->down();
    }

    public function createModels(): void
    {
        $this->createTableCity();
        $this->createTableIp();
    }

    public function addPieceDataCity(array $cities): void
    {
        foreach ($cities as $item) {
            $city = new City;
            $city->geoname_id = $item->geonameId;
            $city->locale_code = $item->localeCode;
            $city->continent_code = $item->continentCode;
            $city->continent_name = $item->continentName;
            $city->country_iso_code = $item->countryIsoCode;
            $city->country_name = $item->countryName;
            $city->subdivision_1_iso_code = $item->subdivision1IsoCode;
            $city->subdivision_1_name = $item->subdivision1Name;
            $city->subdivision_2_iso_code = $item->subdivision2IsoCode;
            $city->subdivision_2_name = $item->subdivision2Name;
            $city->city_name = $item->cityName;
            $city->metro_code = $item->metroCode;
            $city->time_zone = $item->timeZone;
            $city->is_in_european_union = $item->isInEuropeanUnion;
            $city->save();
        }
    }

    public function addPieceDataIp(array $ips): void
    {
        foreach ($ips as $item) {
            $ip = new Ip;
            $ip->network = $item->network;
            $ip->geoname_id = $item->geonameId;
            $ip->registered_country_geoname_id = $item->registeredCountryGeonameId;
            $ip->represented_country_geoname_id = $item->representedCountryGeonameId;
            $ip->is_anonymous_proxy = $item->isAnonymousProxy;
            $ip->is_satellite_provider = $item->isSatelliteProvider;
            $ip->postal_code = $item->postalCode;
            $ip->latitude = $item->latitude;
            $ip->longitude = $item->longitude;
            $ip->accuracy_radius = $item->accuracyRadius;
            $ip->network_from = $item->network_from;
            $ip->network_to = $item->network_to;
            $ip->save();
        }
    }

    public function getInfoByIp(string $ip): array
    {
        $info = [];
        $ipNum = ip2long($ip);
        $infoIp = Ip::cursor()->filter(function ($item) use ($ipNum) {
            $comp1 = bccomp($item->network_from, $ipNum);
            $comp2 = bccomp($item->network_to, $ipNum);
            return $comp1 <= 0 && $comp2 >= 0;
        });



        foreach ($infoIp as $item) {
            $ipDTO = new IpDTO(
                $item->network,
                $item->geoname_id,
                $item->registered_country_geoname_id,
                $item->represented_country_geoname_id,
                $item->is_anonymous_proxy,
                $item->is_satellite_provider,
                $item->postal_code,
                $item->latitude,
                $item->longitude,
                $item->accuracy_radius,
                $item->network_from,
                $item->network_to
            );

            $geonameId = $item->geoname_id;

            $infoCity = City::cursor()->filter(function ($item) use ($geonameId) {
                return $item->geoname_id === $geonameId;
            });

            $cityDTO = null;
            foreach ($infoCity as $itemCity) {
                $cityDTO = new CityDTO(
                    $itemCity->geoname_id,
                    $itemCity->locale_code,
                    $itemCity->continent_code,
                    $itemCity->continent_name,
                    $itemCity->country_iso_code,
                    $itemCity->country_name,
                    $itemCity->subdivision_1_iso_code,
                    $itemCity->subdivision_1_name,
                    $itemCity->subdivision_2_iso_code,
                    $itemCity->subdivision_2_name,
                    $itemCity->city_name,
                    $itemCity->metro_code,
                    $itemCity->time_zone,
                    $itemCity->is_in_european_union
                );
            }

            $info[] = [
                "ip" => $ipDTO->toArray(),
                "city" => $cityDTO->toArray()
            ];
        }
        return $info;
    }
}