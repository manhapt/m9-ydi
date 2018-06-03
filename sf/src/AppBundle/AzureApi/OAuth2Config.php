<?php

namespace AppBundle\AzureApi;

class OAuth2Config
{
    /**
     * @var string
     */
    private $clientId;
    /**
     * @var string
     */
    private $clientSecret;
    /**
     * @var string
     */
    private $urlResourceOwnerDetails;
    /**
     * @var string
     */
    private $resource;
    /**
     * @var string
     */
    private $tenant;
    /**
     * @var string
     */
    private $apiUrl;
    /**
     * @var string
     */
    private $apiVersion;

    /**
     * OAuth2Config constructor.
     * @param string $clientId
     * @param string $clientSecret
     * @param string $urlResourceOwnerDetails
     * @param string $resource
     * @param string $tenant
     * @param string $apiUrl
     * @param string $apiVersion
     */
    public function __construct(
        $clientId,
        $clientSecret,
        $urlResourceOwnerDetails,
        $resource,
        $tenant,
        $apiUrl,
        $apiVersion
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->urlResourceOwnerDetails = $urlResourceOwnerDetails;
        $this->resource = $resource;
        $this->tenant = $tenant;
        $this->apiUrl = $apiUrl;
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    public function getUrlResourceOwnerDetails()
    {
        return $this->urlResourceOwnerDetails;
    }

    /**
     * @param string $urlResourceOwnerDetails
     */
    public function setUrlResourceOwnerDetails($urlResourceOwnerDetails)
    {
        $this->urlResourceOwnerDetails = $urlResourceOwnerDetails;
    }

    /**
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param string $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param string $tenant
     */
    public function setTenant($tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }
}