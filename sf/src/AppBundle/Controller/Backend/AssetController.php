<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Event\AssetLoadEvent;
use AppBundle\Service\FileUploader;
use GuzzleHttp\Psr7;
use AppBundle\Entity\Asset;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/", name="admin_asset_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assets = $em->getRepository('AppBundle:Asset')->findBy(
            [],
            ['created' => 'DESC']
        );

        return $this->render('backend/asset/index.html.twig', array(
            'assets' => $assets,
        ));
    }

    /**
     * Creates a new asset entity.
     *
     * @Route("/new", name="admin_asset_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $asset = new Asset();
        $form = $this->createForm('AppBundle\Form\AssetType', $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileUploader = $this->get('AppBundle\Service\FileUploader');
            if ($asset->getImage()) {
                $asset->setImage($fileUploader->upload($asset->getImage(), 'assets'));
            }
            if ($asset->getDocument()) {
                $asset->setDocument($fileUploader->upload($asset->getDocument(), 'assets'));
            }

            $file = null;
            if ($asset->getFile()) {
                /** @var UploadedFile $file */
                $file = $asset->getFile();
                $fileName = $file->getClientOriginalName();
                $name = substr($fileName, 0, strlen($fileName) - strlen('.' . $file->getClientOriginalExtension()));
                $asset->setName($name);
                $asset->setFile($fileName);
            }

            $this->getDoctrine()->getManager()->persist($asset);
            $this->getDoctrine()->getManager()->flush();

            if ($file) {
                $this->get('azure.uploader.asset')->upload($file);
            }

            return $this->redirectToRoute('admin_asset_show', array('id' => $asset->getId()));
        }

        return $this->render('backend/asset/new.html.twig', array(
            'asset' => $asset,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a asset entity.
     *
     * @Route("/{id}", name="admin_asset_show")
     * @Method("GET")
     */
    public function showAction(Asset $asset)
    {
        $this->preloadAsset($asset);
        $deleteForm = $this->createDeleteForm($asset);

        return $this->render('backend/asset/show.html.twig', array(
            'asset' => $asset,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing asset entity.
     *
     * @Route("/{id}/edit", name="admin_asset_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Asset $asset)
    {
        $this->preloadAsset($asset);
        /** @var FileUploader $fileUploader */
        $fileUploader = $this->get('AppBundle\Service\FileUploader');
        $wpUploadDirAsset = $fileUploader->getTargetDir() . '/assets';
        $prevImage = $asset->getImage();
        if ($prevImage) {
            $asset->setImage(new File($wpUploadDirAsset.'/'.$prevImage));
        }
        $prevDocument = $asset->getDocument();
        if ($prevDocument) {
            $asset->setDocument(new File($wpUploadDirAsset.'/'.$prevDocument));
        }

        $deleteForm = $this->createDeleteForm($asset);
        $editForm = $this->createForm('AppBundle\Form\AssetType', $asset);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($asset->getImage()) {
                $asset->setImage($fileUploader->upload($asset->getImage(), 'assets'));
            } else {
                $asset->setImage($prevImage);
            }

            if ($asset->getDocument()) {
                $asset->setDocument($fileUploader->upload($asset->getDocument(), 'assets'));
            } else {
                $asset->setDocument($prevDocument);
            }

            $this->getDoctrine()->getManager()->persist($asset);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_asset_edit', array('id' => $asset->getId()));
        }

        return $this->render('backend/asset/edit.html.twig', array(
            'asset' => $asset,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a asset entity.
     *
     * @Route("/{id}", name="admin_asset_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Asset $asset)
    {
        $form = $this->createDeleteForm($asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($asset);
            $em->flush();
        }

        return $this->redirectToRoute('admin_asset_index');
    }

    /**
     * Creates a form to delete a asset entity.
     *
     * @param Asset $asset The asset entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Asset $asset)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_asset_delete', array('id' => $asset->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
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
