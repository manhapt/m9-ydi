<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Asset;
use AppBundle\Event\AssetLoadEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Asset controller.
 *
 * @Route("asset")
 */
class AssetController extends Controller
{
    /**
     * Lists all asset entities.
     *
     * @Route("/", name="asset_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assets = $em->getRepository('AppBundle:Asset')->findAll();

        return $this->render('frontend/asset/index.html.twig', array(
            'assets' => $assets,
        ));
    }

    /**
     * Finds and displays a asset entity.
     *
     * @Route("/{id}", name="asset_show")
     * @Method("GET")
     */
    public function showAction(Asset $asset)
    {
        $this->preloadAsset($asset);
        return $this->render('frontend/asset/show.html.twig', array(
            'asset' => $asset,
        ));
    }

    /**
     * @param Asset $asset
     */
    public function preloadAsset(Asset $asset)
    {
        /** @var EventDispatcherInterface $eventDispatcher */
        $eventDispatcher = $this->get('event_dispatcher');
        $eventDispatcher->dispatch(
            AssetLoadEvent::EVENT_NAME,
            new AssetLoadEvent(
                $asset
            )
        );
    }
}
