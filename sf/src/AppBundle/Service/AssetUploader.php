<?php

namespace AppBundle\Service;

use AppBundle\AzureApi\Client;
use AppBundle\Entity\Asset;
use AppBundle\Entity\AzureAccessPolicy;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AssetUploader
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * AssetUploader constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $id
     * @return mixed
     */
    private function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return $this->get('azure.client');
    }

    /**
     * @return ObjectManager
     */
    private function getDoctrine()
    {
        return $this->get('doctrine')->getManager();
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        //setup
        $uploadPolicy = $this->createUploadAccessPolicy();
        $asset = $this->createAsset($file);
        $sasLocator = $this->createSasLocator($uploadPolicy, $asset);
        $uploadUrl = $this->createSASLocatorUrl($asset, $sasLocator);

        //upload asset
        $body = fopen($file->getPathname(), 'r+');
        $this->getClient()->putAsset($uploadUrl, $body);
        $this->getClient()->postFileInfo($asset->getUuid());

        //tear down
        $this->getClient()->deleteLocator($sasLocator['Id']);
    }

    /**
     * @return AzureAccessPolicy
     */
    private function createUploadAccessPolicy()
    {
        $name = 'UploadPolicy' . (new \DateTime('now', new \DateTimeZone('UTC')))->format('Ymd');

        $policy = $this->getDoctrine()->getRepository('AppBundle:AzureAccessPolicy')
            ->findOneBy(['name' => $name]);

        if (!$policy) {
            $policy = new AzureAccessPolicy();
            $policy->setName($name);
            $policy->setDurationInMinutes("1440");
            $policy->setPermission(2);

            $response = $this->getClient()
                ->postAccessPolicy($name, $policy->getDurationInMinutes(), $policy->getPermission());

            $policy->setUuid($response['Id']);

            $this->getDoctrine()->persist($policy);
            $this->getDoctrine()->flush();
        }

        return $policy;
    }


    /**
     * @param UploadedFile $file
     * @return \AppBundle\Entity\Asset
     */
    private function createAsset(UploadedFile $file)
    {
        $response = $this->getClient()->postAsset($file->getClientOriginalName());

        $asset = $this->getDoctrine()->getRepository('AppBundle:Asset')
            ->findOneBy(['file' => $file->getClientOriginalName()]);
        $asset->setUuid($response['Id']);

        $this->getDoctrine()->persist($asset);
        $this->getDoctrine()->flush();

        return $asset;
    }

    /**
     * Create SAS Locator for upload
     *
     * @param AzureAccessPolicy $policy
     * @param Asset $asset
     * @return array
     */
    private function createSASLocator($policy, $asset)
    {
        return $this->getClient()->postSASLocator($policy->getUuid(), $asset->getUuid());
    }

    /**
     * Create the upload URL
     *
     * @param Asset $asset
     * @param array $sasLocator
     * @return string
     */
    private function createSASLocatorUrl($asset, $sasLocator)
    {
        return $sasLocator['BaseUri'] . '/' . $asset->getFile() . $sasLocator['ContentAccessComponent'];
    }
}
