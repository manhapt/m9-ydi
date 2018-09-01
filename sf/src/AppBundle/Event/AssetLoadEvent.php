<?php

namespace AppBundle\Event;

use AppBundle\Entity\Asset;
use Symfony\Component\EventDispatcher\Event;

class AssetLoadEvent extends Event
{
    const EVENT_NAME = 'ydi.asset.load';
    /**
     * @var Asset
     */
    private $asset;

    /**
     * AssetLoadEvent constructor.
     * @param Asset $asset
     */
    public function __construct($asset)
    {
        $this->asset = $asset;
    }

    /**
     * @return Asset
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * @param Asset $asset
     */
    public function setAsset($asset)
    {
        $this->asset = $asset;
    }
}