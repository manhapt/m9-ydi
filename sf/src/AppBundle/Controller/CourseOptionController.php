<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CourseOption;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Courseoption controller.
 *
 * @Route("courseoption")
 */
class CourseOptionController extends Controller
{
    /**
     * Lists all courseOption entities.
     *
     * @Route("/", name="courseoption_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courseOptions = $em->getRepository('AppBundle:CourseOption')->findAll();

        return $this->render('courseoption/index.html.twig', array(
            'courseOptions' => $courseOptions,
        ));
    }

    /**
     * Creates a new courseOption entity.
     *
     * @Route("/new", name="courseoption_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $courseOption = new Courseoption();
        $form = $this->createForm('AppBundle\Form\CourseOptionType', $courseOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($courseOption);
            $em->flush();

            return $this->redirectToRoute('courseoption_show', array('id' => $courseOption->getId()));
        }

        return $this->render('courseoption/new.html.twig', array(
            'courseOption' => $courseOption,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a courseOption entity.
     *
     * @Route("/{id}", name="courseoption_show")
     * @Method("GET")
     */
    public function showAction(CourseOption $courseOption)
    {
        $deleteForm = $this->createDeleteForm($courseOption);

        return $this->render('courseoption/show.html.twig', array(
            'courseOption' => $courseOption,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing courseOption entity.
     *
     * @Route("/{id}/edit", name="courseoption_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CourseOption $courseOption)
    {
        $deleteForm = $this->createDeleteForm($courseOption);
        $editForm = $this->createForm('AppBundle\Form\CourseOptionType', $courseOption);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('courseoption_edit', array('id' => $courseOption->getId()));
        }

        return $this->render('courseoption/edit.html.twig', array(
            'courseOption' => $courseOption,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a courseOption entity.
     *
     * @Route("/{id}", name="courseoption_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CourseOption $courseOption)
    {
        $form = $this->createDeleteForm($courseOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($courseOption);
            $em->flush();
        }

        return $this->redirectToRoute('courseoption_index');
    }

    /**
     * Creates a form to delete a courseOption entity.
     *
     * @param CourseOption $courseOption The courseOption entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CourseOption $courseOption)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('courseoption_delete', array('id' => $courseOption->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
