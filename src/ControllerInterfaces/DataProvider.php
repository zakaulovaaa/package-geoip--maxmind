<?php

namespace GeoIp\Interfaces;

use GeoIp\DTO\CityDTO;
use GeoIp\DTO\IpDTO;

/**
 * Interface DataProvider
 * @package GeoIp\Interfaces
 */
interface DataProvider {

    public function createModels(): void;

    /**
     * @param array<CityDTO> $cities
     */
    public function addPieceDataCity(array $cities): void;

    /**
     * @param array<IpDTO> $ips
     */
    public function addPieceDataIp(array $ips): void;

    /**
     * @param string $ip
     * @return array
     */
    public function getInfoByIp(string $ip): array;

}
