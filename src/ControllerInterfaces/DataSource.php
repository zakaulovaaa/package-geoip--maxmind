<?php

namespace GeoIp\Interfaces;

use GeoIp\DTO\CityDTO;
use GeoIp\DTO\IpDTO;

/**
 * Interface DataSource
 * @package GeoIp\Interfaces
 */
interface DataSource {
    /**
     * @return bool  //true -- если в результате получения данных ошибок не возникло, иначе -- false
     */
    public function downloadDataSource(): bool;

    /**
     * @param int $numPage
     * @param int $step
     * @param string $type
     * @param array $filter
     * @return array<CityDTO|IpDTO>
     */
    public function getPieceOfData(int $numPage, int $step, string $type, array $filter): array;

    /**
     * @param string $type
     * @return array
     */
    public function getInfoDataByType(string $type): array;

}
