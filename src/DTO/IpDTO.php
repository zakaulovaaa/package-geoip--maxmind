<?php


namespace GeoIp\DTO;


class IpDTO
{
    private string $network;
    private string $geonameId;
    private ?string $registeredCountryGeonameId;
    private ?string $representedCountryGeonameId;
    private ?string $isAnonymousProxy;
    private ?string $isSatelliteProvider;
    private ?string $postalCode;
    private ?string $latitude;
    private ?string $longitude;
    private ?string $accuracyRadius;
    private ?string $networkFrom;
    private ?string $networkTo;

    /**
     * IpDTO constructor.
     * @param string $network
     * @param string $geonameId
     * @param string|null $registeredCountryGeonameId
     * @param string|null $representedCountryGeonameId
     * @param string|null $isAnonymousProxy
     * @param string|null $isSatelliteProvider
     * @param string|null $postalCode
     * @param string|null $latitude
     * @param string|null $longitude
     * @param string|null $accuracyRadius
     * @param string|null $networkFrom
     * @param string|null $networkTo
     */
    public function __construct(string $network, string $geonameId, ?string $registeredCountryGeonameId,
                                ?string $representedCountryGeonameId, ?string $isAnonymousProxy,
                                ?string $isSatelliteProvider, ?string $postalCode, ?string $latitude,
                                ?string $longitude, ?string $accuracyRadius, ?string $networkFrom, ?string $networkTo)
    {
        $this->network = $network;
        $this->geonameId = $geonameId;
        $this->registeredCountryGeonameId = $registeredCountryGeonameId;
        $this->representedCountryGeonameId = $representedCountryGeonameId;
        $this->isAnonymousProxy = $isAnonymousProxy;
        $this->isSatelliteProvider = $isSatelliteProvider;
        $this->postalCode = $postalCode;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->accuracyRadius = $accuracyRadius;
        $this->networkFrom = $networkFrom;
        $this->networkTo = $networkTo;
    }

    public function toArray(): array
    {
        return [
            "network" => $this->network,
            "geonameId" => $this->geonameId,
            "registeredCountryGeonameId" => $this->registeredCountryGeonameId,
            "representedCountryGeonameId" => $this->representedCountryGeonameId,
            "isAnonymousProxy" => $this->isAnonymousProxy,
            "isSatelliteProvider" => $this->isSatelliteProvider,
            "postalCode" => $this->postalCode,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "accuracyRadius" => $this->accuracyRadius,
            "networkFrom" => $this->networkFrom,
            "networkTo" => $this->networkTo,
        ];
    }

    /**
     * @return string
     */
    public function getNetwork(): string
    {
        return $this->network;
    }

    /**
     * @param string $network
     */
    public function setNetwork(string $network): void
    {
        $this->network = $network;
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
    public function getRegisteredCountryGeonameId(): ?string
    {
        return $this->registeredCountryGeonameId;
    }

    /**
     * @param string|null $registeredCountryGeonameId
     */
    public function setRegisteredCountryGeonameId(?string $registeredCountryGeonameId): void
    {
        $this->registeredCountryGeonameId = $registeredCountryGeonameId;
    }

    /**
     * @return string|null
     */
    public function getRepresentedCountryGeonameId(): ?string
    {
        return $this->representedCountryGeonameId;
    }

    /**
     * @param string|null $representedCountryGeonameId
     */
    public function setRepresentedCountryGeonameId(?string $representedCountryGeonameId): void
    {
        $this->representedCountryGeonameId = $representedCountryGeonameId;
    }

    /**
     * @return string|null
     */
    public function getIsAnonymousProxy(): ?string
    {
        return $this->isAnonymousProxy;
    }

    /**
     * @param string|null $isAnonymousProxy
     */
    public function setIsAnonymousProxy(?string $isAnonymousProxy): void
    {
        $this->isAnonymousProxy = $isAnonymousProxy;
    }

    /**
     * @return string|null
     */
    public function getIsSatelliteProvider(): ?string
    {
        return $this->isSatelliteProvider;
    }

    /**
     * @param string|null $isSatelliteProvider
     */
    public function setIsSatelliteProvider(?string $isSatelliteProvider): void
    {
        $this->isSatelliteProvider = $isSatelliteProvider;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     */
    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string|null
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     */
    public function setLatitude(?string $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string|null
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     */
    public function setLongitude(?string $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string|null
     */
    public function getAccuracyRadius(): ?string
    {
        return $this->accuracyRadius;
    }

    /**
     * @param string|null $accuracyRadius
     */
    public function setAccuracyRadius(?string $accuracyRadius): void
    {
        $this->accuracyRadius = $accuracyRadius;
    }

    /**
     * @return string|null
     */
    public function getNetworkFrom(): ?string
    {
        return $this->networkFrom;
    }

    /**
     * @param string|null $networkFrom
     */
    public function setNetworkFrom(?string $networkFrom): void
    {
        $this->networkFrom = $networkFrom;
    }

    /**
     * @return string|null
     */
    public function getNetworkTo(): ?string
    {
        return $this->networkTo;
    }

    /**
     * @param string|null $networkTo
     */
    public function setNetworkTo(?string $networkTo): void
    {
        $this->networkTo = $networkTo;
    }
}
