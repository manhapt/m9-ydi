<?php

namespace AppBundle\AzureApi;

use TheNetworg\OAuth2\Client\Provider\Azure;

class ProviderFactory
{
    /**
     * @param OAuth2Config $config
     * @return Azure
     */
    public function create(OAuth2Config $config)
    {
        $provider  = new Azure([
            'clientId'          => $config->getClientId(),
            'clientSecret'      => $config->getClientSecret(),
            'urlResourceOwnerDetails' => $config->getUrlResourceOwnerDetails(),
        ]);
        $provider->resource = $config->getResource();
        $provider->tenant = $config->getTenant();
        $provider->urlAPI = $config->getApiUrl();
        $provider->API_VERSION = $config->getApiVersion();

        return $provider;
    }
}