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
        $policy = $this->createUploadAccessPolicy();
        $asset = $this->createAsset($file);
        $uploadUrl = $this->createSasLocator($policy, $asset);

        $body = fopen($file->getPathname(), 'r+');
        $this->getClient()->putAsset($uploadUrl, $body);
        $this->getClient()->postFileInfo($asset->getUuid());
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
     * Create the upload URL
     *
     * @param AzureAccessPolicy $policy
     * @param Asset $asset
     * @return string
     */
    private function createSASLocator($policy, $asset)
    {
        $response = $this->getClient()->postSASLocator($policy->getUuid(), $asset->getUuid());

        return $response['BaseUri'] . '/' . $asset->getFile() . $response['ContentAccessComponent'];
    }
}
