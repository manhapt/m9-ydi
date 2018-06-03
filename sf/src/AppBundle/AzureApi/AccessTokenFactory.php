<?php

namespace AppBundle\AzureApi;

use TheNetworg\OAuth2\Client\Provider\Azure;

class AccessTokenFactory
{
    /**
     * @param Azure $provider
     * @return \League\OAuth2\Client\Token\AccessToken
     */
    public function create(Azure $provider)
    {
        $provider->getAuthorizationUrl();

        return $provider->getAccessToken('client_credentials', [
            'code' => $provider->getState(),
            'resource' => $provider->resource,
        ]);
    }
}