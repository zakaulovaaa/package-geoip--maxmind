<?php

namespace GeoIp\Controller;

use \GeoIp\DTO\CityDTO;
use \GeoIp\DTO\IpDTO;
use \GeoIp\ControllerInterfaces\DataSource;


class ControllerMaxmind implements DataSource
{

    private const PATH_TO_FILE_WITH_INFO_CITY = "/temporary-geoip/GeoLite2-City-CSV_20210309/GeoLite2-City-Locations-ru.csv";
    private const PATH_TO_FILE_WITH_INFO_IP = "/temporary-geoip/GeoLite2-City-CSV_20210309/GeoLite2-City-Blocks-IPv4.csv";
    private const ARCHIVE_NAME = "/db.zip";

    private string $url;
    private string $temporaryDir;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->temporaryDir = $_SERVER['DOCUMENT_ROOT'] . "/test/temporary-geoip";
    }


    private function getStrOrNull(string $s): ?string
    {
        return (isset($s) && $s !== '') ? $s : null;
    }

    private function rowToCityDTO($row): CityDTO
    {
        return new CityDTO(
            $this->getStrOrNull($row["geoname_id"]),
            $this->getStrOrNull($row["locale_code"]),
            $this->getStrOrNull($row["continent_code"]),
            $this->getStrOrNull($row["continent_name"]),
            $this->getStrOrNull($row["country_iso_code"]),
            $this->getStrOrNull($row["country_name"]),
            $this->getStrOrNull($row["subdivision_1_iso_code"]),
            $this->getStrOrNull($row["subdivision_1_name"]),
            $this->getStrOrNull($row["subdivision_2_iso_code"]),
            $this->getStrOrNull($row["subdivision_2_name"]),
            $this->getStrOrNull($row["city_name"]),
            $this->getStrOrNull($row["metro_code"]),
            $this->getStrOrNull($row["time_zone"]),
            $this->getStrOrNull($row["is_in_european_union"])
        );
    }

    private static function cidrToRangeV4($cidr): array
    {
        $cidr = explode('/', $cidr);

        $from = long2ip((ip2long($cidr[0])) & ((-1 << (32 - (int)$cidr[1]))));
        $to = long2ip((ip2long($from)) + pow(2, (32 - (int)$cidr[1])) - 1);

        return [ip2long($from), ip2long($to)];
    }

    private function rowToIpDTO($row): IpDTO
    {
        $network = [null, null];
        if (isset($ip->network)) {
            $network = self::cidrToRangeV4($ip->network);
        }
        return new IpDTO(
            $this->getStrOrNull($row["network"]),
            $this->getStrOrNull($row["geoname_id"]),
            $this->getStrOrNull($row["registered_country_geoname_id"]),
            $this->getStrOrNull($row["represented_country_geoname_id"]),
            $this->getStrOrNull($row["is_anonymous_proxy"]),
            $this->getStrOrNull($row["is_satellite_provider"]),
            $this->getStrOrNull($row["postal_code"]),
            $this->getStrOrNull($row["latitude"]),
            $this->getStrOrNull($row["longitude"]),
            $this->getStrOrNull($row["accuracy_radius"]),
            $network[0],
            $network[1]
        );
    }

    private static function filterRow($row = [], $filters = []): bool
    {
        if (empty($filters)) {
            return true;
        }

        foreach ($filters as $key => $values) {
            if (isset($row[$key]) && !in_array($row[$key], $values, true)) {
                return false;
            }
        }
        return true;
    }

    private function getInfoData($csvFile = ''): array
    {
        $file = file($csvFile);
        $cnt = count($file);
        return [
            "size" => $cnt
        ];
    }

    public function downloadDataSource()
    {
        try {
//            \GeoIp\Helper\HelperWorkingWithFiles::downloadData($this->url, $this->temporaryDir,
//                $this->temporaryDir . self::ARCHIVE_NAME);
//            \GeoIp\Helper\HelperWorkingWithFiles::unzipData($this->temporaryDir . self::ARCHIVE_NAME,
//                $this->temporaryDir);
            $fileCity = resource_path(self::PATH_TO_FILE_WITH_INFO_CITY);
            $fileIp = resource_path(self::PATH_TO_FILE_WITH_INFO_IP);

            return [
                "city" => $this->getInfoData($fileCity),
                "ip" => [
                    'size' => $this->getInfoData($fileIp)
                ]
            ];
        } catch (Exception $e) {
            return false;
        }
    }


    function uploadPieceOfDataCSV($sizeFile, int $left, int $right, string $type, $csvFile = '', array $filter = []): array {
        $allData = [];

        $fileCSV = fopen($csvFile, 'r');
        $keys = fgetcsv($fileCSV);

        for ($i = 1; $i < $left; $i++) {
            fgets($fileCSV);
        }
        for ($i = $left; $i < $right; $i++) {
            $row = fgetcsv($fileCSV);
            $rowData = array_combine($keys, $row);

            if (self::filterRow($rowData, $filter)) {
                if ($type === "city") {
                    $allData[] = $this->rowToCityDTO($rowData);
                }
                if ($type === 'ip') {
                    $allData[] = $this->rowToIpDTO($rowData);
                }
            }
        }

        return $allData;
    }


    public function getPieceOfData(int $numPage, int $step, string $type, array $filter): array
    {
        $fileCSV = "";
        if ($type === "city") {
            $fileCSV = resource_path(self::PATH_TO_FILE_WITH_INFO_CITY);
        } elseif ($type === "ip") {
            $fileCSV = resource_path(self::PATH_TO_FILE_WITH_INFO_IP);
        }

        $info = $this->getInfoData($fileCSV);
        $left = ($numPage - 1) * $step + 1;
        $right = min($step * $numPage + 1, $info["size"]);
        if ($left >= $info["size"]) {
            return [
                "info" => [
                    "nextPage" => -1,
                    "left" => $left,
                    "right" => $right,
                    "size" => $info["size"]
                ]
            ];
        }
        $nextPage = $numPage + 1;

        if ($info["size"] === $right) {
            $nextPage = -1;
        }

        $data = $this->uploadPieceOfDataCSV($info["size"], $left, $right, $type, $fileCSV, $filter);
        return [
            "data" => $data,
            "info" => [
                "nextPage" => $nextPage
            ]
        ];
    }

    public function getInfoDataByType(string $type): array
    {
        if ($type === "city") {
            return $this->getInfoData(resource_path(self::PATH_TO_FILE_WITH_INFO_CITY));
        }

        if ($type === "ip") {
            return $this->getInfoData(resource_path(self::PATH_TO_FILE_WITH_INFO_IP));
        }

        return [];
    }
}