<?php

namespace AppBundle\Event;

use AppBundle\AzureApi\Client;
use AppBundle\Entity\Asset;
use AppBundle\Entity\AzureAccessPolicy;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\Event;


class AssetLoadListener
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * AssetLoadListener constructor.
     * @param Client $client
     * @param RegistryInterface $doctrine
     */
    public function __construct(
        Client $client,
        RegistryInterface $doctrine
    ) {
        $this->client = $client;
        $this->doctrine = $doctrine;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEntityManager()
    {
        return $this->doctrine->getEntityManager();
    }

    public function onAssetLoad(AssetLoadEvent $event)
    {
        $asset = $event->getAsset();

        if (null == $asset->getJobUuid()) {
            //start encoding
            $job = $this->createEncodeAssetJob($asset);

            $asset->setJobState((int) $job['d']['State']);
            $asset->setJobUuid($job['d']['Id']);
        }
        //Encoding Finished = 3|Error = 4|Canceled = 5|Canceling = 6
        elseif ($asset->getJobState() < 3) {
            $jobState = $this->client->getJobState($asset->getJobUuid());
            $asset->setJobState((int) $jobState);
        }

        if (null === $asset->getUri() && 3 === $asset->getJobState()) {
            //publish asset
            $encodedAsset = $this->client->getJobOutputAsset($asset->getJobUuid());
            $asset->setEncodedUuid($encodedAsset[0]['Id']);

            $downloadPolicy = $this->createDownloadAccessPolicy();
            $streamingLocator = $this->createStreamingLocator($downloadPolicy, $asset);
            $asset->setUri($streamingLocator['Path']);
        }

        $this->getEntityManager()->persist($asset);
        $this->getEntityManager()->flush();
    }


    /**
     * @return AzureAccessPolicy
     */
    private function createDownloadAccessPolicy()
    {
        $name = 'DownloadPolicy';

        $policy = $this->getEntityManager()->getRepository('AppBundle:AzureAccessPolicy')
            ->findOneBy(['name' => $name]);

        if (!$policy) {
            $policy = new AzureAccessPolicy();
            $policy->setName($name);
            $policy->setDurationInMinutes("52594560");
            $policy->setPermission(1);

            $response = $this->client
                ->postAccessPolicy($name, $policy->getDurationInMinutes(), $policy->getPermission());

            $policy->setUuid($response['Id']);

            $this->getEntityManager()->persist($policy);
            $this->getEntityManager()->flush();
        }

        return $policy;
    }

    /**
     * Create SAS Locator for upload
     *
     * @param AzureAccessPolicy $policy
     * @param Asset $asset
     * @return array
     */
    private function createStreamingLocator($policy, $asset)
    {
        $startDate = (new \DateTime('now -1 day'))->format("Y-m-d\TH:i:s");

        return $this->client->postStreamingLocator($policy->getUuid(), $asset->getEncodedUuid(), $startDate);
    }

    /**
     * @param Asset $asset
     * @return array
     */
    private function createEncodeAssetJob($asset)
    {
        $name = "encoded-{$asset->getFile()}";
        $body = ['Name' => $name];
        $body['InputMediaAssets'] = [
            [
                '__metadata' => [
                    'uri' => "https://ydimedia.restv2.southeastasia.media.azure.net/api/Assets('{$asset->getUuid()}')"
                ]
            ]
        ];
        $taskBody1 = <<<TBD
<?xml version="1.0" encoding="utf-8"?><taskBody><inputAsset>JobInputAsset(0)</inputAsset><outputAsset assetName="
TBD;
        $taskBody2 = <<<CBD
">JobOutputAsset(0)</outputAsset></taskBody>
CBD;

        $body['Tasks'] = [
            [
                'Configuration' => 'Content Adaptive Multiple Bitrate MP4',
                'MediaProcessorId' => "nb:mpid:UUID:ff4df607-d419-42f0-bc17-a481b1331e56",
                'TaskBody' => $taskBody1 . $name . $taskBody2
            ]
        ];

        return $this->client->postJob($body);
    }
}