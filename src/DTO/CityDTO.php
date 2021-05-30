<?php


namespace GeoIp\DTO;


class CityDTO
{
    private string $geonameId;
    private ?string $localeCode;
    private ?string $continentCode;
    private ?string $continentName;
    private ?string $countryIsoCode;
    private ?string $countryName;
    private ?string $subdivision1IsoCode;
    private ?string $subdivision1Name;
    private ?string $subdivision2IsoCode;
    private ?string $subdivision2Name;
    private ?string $cityName;
    private ?string $metroCode;
    private ?string $timeZone;
    private ?string $isInEuropeanUnion;

    public function __construct($geonameId, $localeCode, $continentCode, $continentName, $countryIsoCode,
                                $countryName, $subdivision1IsoCode, $subdivision1Name, $subdivision2IsoCode,
                                $subdivision2Name, $cityName, $metroCode, $timeZone, $isInEuropeanUnion)
    {
        $this->geonameId = $geonameId;
        $this->localeCode = $localeCode;
        $this->continentCode = $continentCode;
        $this->continentName = $continentName;
        $this->countryIsoCode = $countryIsoCode;
        $this->countryName = $countryName;
        $this->subdivision1IsoCode = $subdivision1IsoCode;
        $this->subdivision1Name = $subdivision1Name;
        $this->subdivision2IsoCode = $subdivision2IsoCode;
        $this->subdivision2Name = $subdivision2Name;
        $this->cityName = $cityName;
        $this->metroCode = $metroCode;
        $this->timeZone = $timeZone;
        $this->isInEuropeanUnion = $isInEuropeanUnion;
    }

    public function toArray(): array
    {
        return [
            "geonameId" => $this->geonameId,
            "localeCode" => $this->localeCode,
            "continentCode" => $this->continentCode,
            "continentName" => $this->continentName,
            "countryIsoCode" => $this->countryIsoCode,
            "countryName" => $this->countryName,
            "subdivision1IsoCode" => $this->subdivision1IsoCode,
            "subdivision1Name" => $this->subdivision1Name,
            "subdivision2IsoCode" => $this->subdivision2IsoCode,
            "subdivision2Name" => $this->subdivision2Name,
            "cityName" => $this->cityName,
            "metroCode" => $this->metroCode,
            "timeZone" => $this->timeZone,
            "isInEuropeanUnion" => $this->isInEuropeanUnion,
        ];
    }


    /**
     * @return string
     */
    public function getGeonameId(): string
    {
        return $this->geonameId;
    }

    /**
     * @param string $geonameId
     */
    public function setGeonameId(string $geonameId): void
    {
        $this->geonameId = $geonameId;
    }

    /**
     * @return string|null
     */
    public function getLocaleCode(): ?string
    {
        return $this->localeCode;
    }

    /**
     * @param string|null $localeCode
     */
    public function setLocaleCode(?string $localeCode): void
    {
        $this->localeCode = $localeCode;
    }

    /**
     * @return string|null
     */
    public function getContinentCode(): ?string
    {
        return $this->continentCode;
    }

    /**
     * @param string|null $continentCode
     */
    public function setContinentCode(?string $continentCode): void
    {
        $this->continentCode = $continentCode;
    }

    /**
     * @return string|null
     */
    public function getContinentName(): ?string
    {
        return $this->continentName;
    }

    /**
     * @param string|null $continentName
     */
    public function setContinentName(?string $continentName): void
    {
        $this->continentName = $continentName;
    }

    /**
     * @return string|null
     */
    public function getCountryIsoCode(): ?string
    {
        return $this->countryIsoCode;
    }

    /**
     * @param string|null $countryIsoCode
     */
    public function setCountryIsoCode(?string $countryIsoCode): void
    {
        $this->countryIsoCode = $countryIsoCode;
    }

    /**
     * @return string|null
     */
    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    /**
     * @param string|null $countryName
     */
    public function setCountryName(?string $countryName): void
    {
        $this->countryName = $countryName;
    }

    /**
     * @return string|null
     */
    public function getSubdivision1IsoCode(): ?string
    {
        return $this->subdivision1IsoCode;
    }

    /**
     * @param string|null $subdivision1IsoCode
     */
    public function setSubdivision1IsoCode(?string $subdivision1IsoCode): void
    {
        $this->subdivision1IsoCode = $subdivision1IsoCode;
    }

    /**
     * @return string|null
     */
    public function getSubdivision1Name(): ?string
    {
        return $this->subdivision1Name;
    }

    /**
     * @param string|null $subdivision1Name
     */
    public function setSubdivision1Name(?string $subdivision1Name): void
    {
        $this->subdivision1Name = $subdivision1Name;
    }

    /**
     * @return string|null
     */
    public function getSubdivision2IsoCode(): ?string
    {
        return $this->subdivision2IsoCode;
    }

    /**
     * @param string|null $subdivision2IsoCode
     */
    public function setSubdivision2IsoCode(?string $subdivision2IsoCode): void
    {
        $this->subdivision2IsoCode = $subdivision2IsoCode;
    }

    /**
     * @return string|null
     */
    public function getSubdivision2Name(): ?string
    {
        return $this->subdivision2Name;
    }

    /**
     * @param string|null $subdivision2Name
     */
    public function setSubdivision2Name(?string $subdivision2Name): void
    {
        $this->subdivision2Name = $subdivision2Name;
    }

    /**
     * @return string|null
     */
    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    /**
     * @param string|null $cityName
     */
    public function setCityName(?string $cityName): void
    {
        $this->cityName = $cityName;
    }

    /**
     * @return string|null
     */
    public function getMetroCode(): ?string
    {
        return $this->metroCode;
    }

    /**
     * @param string|null $metroCode
     */
    public function setMetroCode(?string $metroCode): void
    {
        $this->metroCode = $metroCode;
    }

    /**
     * @return string|null
     */
    public function getTimeZone(): ?string
    {
        return $this->timeZone;
    }

    /**
     * @param string|null $timeZone
     */
    public function setTimeZone(?string $timeZone): void
    {
        $this->timeZone = $timeZone;
    }

    /**
     * @return string|null
     */
    public function getIsInEuropeanUnion(): ?string
    {
        return $this->isInEuropeanUnion;
    }

    /**
     * @param string|null $isInEuropeanUnion
     */
    public function setIsInEuropeanUnion(?string $isInEuropeanUnion): void
    {
        $this->isInEuropeanUnion = $isInEuropeanUnion;
    }

}
