<?php

namespace GeoIp;

use GeoIp\Helper\HelperIp;
use GeoIp\ControllerInterfaces\DataProvider;
use GeoIp\ControllerInterfaces\DataSource;

class GeoIp {

    /**
     * @var DataProvider
     * @var DataSource
     */
    protected DataProvider $dataProvider;
    protected DataSource $dataSource;

    /**
     * GeoIp constructor.
     * @param DataProvider $dataProvider
     * @param DataSource $dataSource
     */
    public function __construct(DataSource $dataSource, DataProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
        $this->dataSource = $dataSource;
    }

    public function downloadDataSource(): bool
    {
        return $this->dataSource->downloadDataSource();
    }

    public function getPieceOfData(string $type, int $numPage = 1, int $step = 10000): array
    {
        // добавлять в бд ip только городов из России
        $filter = ['registered_country_geoname_id' => ['2017370']];
        $piece = $this->dataSource->getPieceOfData($numPage, $step, $type, $filter);
        if (!empty($piece["data"])) {
            if ($type === "city") {
                $this->dataProvider->addPieceDataCity($piece["data"]);
            } elseif ($type === "ip") {
                $this->dataProvider->addPieceDataIp($piece["data"]);
            }
        }
        return [
            "info" => $piece["info"]
        ];
    }

    public function getInfoData(string $type) : array
    {
        return $this->dataSource->getInfoDataByType($type);
    }

    public function createTables(): void
    {
        $this->dataProvider->createModels();
    }

    public function getInfoCityByIp(string $ip): array
    {
        return $this->dataProvider->getInfoByIp($ip);
    }

    public function getInfoByCurrentIp(): array
    {
        $ip = HelperIp::getCurrentIdAddress();
        return $this->dataProvider->getInfoByIp($ip);
    }
}
