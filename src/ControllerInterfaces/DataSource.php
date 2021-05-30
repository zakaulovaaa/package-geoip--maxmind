<?php

namespace GeoIp\ControllerInterfaces;

use GeoIp\DTO\CityDTO;
use GeoIp\DTO\IpDTO;

/**
 * Interface DataSource
 * @package GeoIp\ControllerInterfaces
 */
interface DataSource {
    /**
     * @return array|bool
     */
    public function downloadDataSource();

    /**
     * @param int $numPage
     * @param int $step
     * @param string $type
     * @param array $filter
     * @return array<CityDTO>|array<IpDTO>
     */
    public function getPieceOfData(int $numPage, int $step, string $type, array $filter): array;

    /**
     * @param string $type
     * @return array
     */
    public function getInfoDataByType(string $type): array;

}
