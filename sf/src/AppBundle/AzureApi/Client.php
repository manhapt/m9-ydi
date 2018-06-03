<?php

namespace AppBundle\AzureApi;

use TheNetworg\OAuth2\Client\Provider\Azure;
use League\OAuth2\Client\Token\AccessToken;

class Client
{
    /**
     * @var Azure
     */
    private $provider;
    /**
     * @var AccessToken
     */
    private $token;

    /**
     * Client constructor.
     * @param Azure $provider
     * @param AccessToken $token
     */
    public function __construct(
        Azure $provider,
        AccessToken $token
    ) {
        $this->provider = $provider;
        $this->token = $token;
    }

    private function post($ref, $body, &$accessToken, $headers = [])
    {
        $headers['Accept'] = 'application/json';
        
        return $this->provider->post($ref, $body, $accessToken, $headers);
    }

    /**
     * @param string $name
     * @param string $durationInMinutes
     * @param int $permission
     * @return mixed
     */
    public function postAccessPolicy($name, $durationInMinutes, $permission)
    {
        return $this->post(
            "AccessPolicies",
            [
                "Name" => $name,
                "DurationInMinutes" => $durationInMinutes,
                "Permissions" => $permission
            ],
            $this->token
        );
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function postAsset($name)
    {
        return $this->post("Assets", ["Name" => $name], $this->token);
    }

    /**
     * @param string $uploadUrl
     * @param $body
     * @return mixed
     */
    public function putAsset($uploadUrl, $body)
    {
        $request = $this->provider->getRequest(
            'put',
            $uploadUrl,
            [
                'body' => $body,
                'headers' => ['x-ms-blob-type' => 'BlockBlob']
            ]
        );

        return $this->provider->getParsedResponse($request);
    }

    /**
     * @param $accessPolicyId
     * @param $assetId
     * @return null
     */
    public function postSASLocator($accessPolicyId, $assetId)
    {
        return $this->post(
            'Locators',
            ["AccessPolicyId" => $accessPolicyId, "AssetId" => $assetId, 'Type' => 1],
            $this->token
        );
    }

    /**
     * @param string $assetId
     * @return mixed
     */
    public function postFileInfo($assetId)
    {
        return $this->provider->get(
            "CreateFileInfos?assetid='{$assetId}'",
            $this->token
        );
    }
}