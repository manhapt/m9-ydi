<?php

namespace AppBundle\AzureApi;

use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\Cache\Simple\FilesystemCache;
use TheNetworg\OAuth2\Client\Provider\Azure;

class AccessTokenFactory
{
    /**
     * @param Azure $provider
     * @return AccessToken
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function create(Azure $provider)
    {
        $cache = new FilesystemCache();

        if ($cache->hasItem('azure_access_token')) {
            /** @var AccessToken $savedToken */
            $savedToken = unserialize($cache->get('azure_access_token'));
            if (false === $savedToken->hasExpired()) {
                return $savedToken;
            }
        }
        $token = $this->createToken($provider);
        $cache->set('azure_access_token', serialize($token));

        return $token;
    }

    /**
     * @param Azure $provider
     * @return AccessToken
     */
    private function createToken(Azure $provider)
    {
        $provider->getAuthorizationUrl();

        return $provider->getAccessToken('client_credentials', [
            'code' => $provider->getState(),
            'resource' => $provider->resource,
        ]);
    }
}