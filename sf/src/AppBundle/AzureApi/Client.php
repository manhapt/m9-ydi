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
        if (empty($headers['Accept'])) {
            $headers['Accept'] = 'application/json';
        }

        return $this->provider->post($ref, $body, $accessToken, $headers);
    }

    private function get($ref, &$accessToken, $headers = [])
    {
        $headers['Accept'] = 'application/json';

        return $this->provider->get($ref, $accessToken, $headers);
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
     * @param $accessPolicyId
     * @param $assetId
     * @param $startTime (format: 2014-05-17T16:45:53)
     * @return null
     */
    public function postStreamingLocator($accessPolicyId, $assetId, $startTime)
    {
        return $this->post(
            'Locators',
            ["AccessPolicyId" => $accessPolicyId, "AssetId" => $assetId, 'StartTime' => $startTime, 'Type' => 2],
            $this->token
        );
    }

    /**
     * @param string $uuid
     * @return null
     */
    public function deleteLocator($uuid)
    {
        return $this->provider->delete("Locators('{$uuid}')", $this->token);
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

    /**
     * @param array $body
     * @return null
     */
    public function postJob($body)
    {
        return $this->post(
            'Jobs',
            $body,
            $this->token,
            [
                'Accept' => 'application/json;odata=verbose',
                'Content-Type' => 'application/json;odata=verbose',
                'DataServiceVersion' => '3.0',
                'MaxDataServiceVersion' => '3.0'
            ]
        );
    }

    /**
     * @param string $uuid
     * @return array
     */
    public function getJobState($uuid)
    {
        return $this->get("Jobs('{$uuid}')/State", $this->token);
    }

    /**
     * @param string $uuid
     * @return array
     */
    public function getJobOutputAsset($uuid)
    {
        return $this->get(
            "Jobs('$uuid')/OutputMediaAssets",
            $this->token
        );
    }
}