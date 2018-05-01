<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Course;
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
     * @Route("/{id}/", name="admin_courseoption_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, Course $course)
    {
        $em = $this->getDoctrine()->getManager();

        $courseOptions = $em->getRepository('AppBundle:CourseOption')->findAll();

        return $this->render('backend/courseoption/index.html.twig', array(
            'courseOptions' => $courseOptions,
        ));
    }

    /**
     * Creates a new courseOption entity.
     *
     * @Route("/{id}/new", name="admin_courseoption_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Course $course)
    {
        $courseOption = new Courseoption();
        $courseOption->setCourse($course);
        $form = $this->createForm('AppBundle\Form\CourseOptionType', $courseOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($courseOption);
            $em->flush();

            return $this->redirectToRoute('admin_courseoption_show', array('id' => $courseOption->getId()));
        }

        return $this->render('backend/courseoption/new.html.twig', array(
            'courseOption' => $courseOption,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a courseOption entity.
     *
     * @Route("/{id}/show", name="admin_courseoption_show")
     * @Method("GET")
     */
    public function showAction(CourseOption $courseOption)
    {
        $deleteForm = $this->createDeleteForm($courseOption);

        return $this->render('backend/courseoption/show.html.twig', array(
            'courseOption' => $courseOption,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing courseOption entity.
     *
     * @Route("/{id}/edit", name="admin_courseoption_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CourseOption $courseOption)
    {
        $deleteForm = $this->createDeleteForm($courseOption);
        $editForm = $this->createForm('AppBundle\Form\CourseOptionType', $courseOption);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_courseoption_edit', array('id' => $courseOption->getId()));
        }

        return $this->render('backend/courseoption/edit.html.twig', array(
            'courseOption' => $courseOption,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a courseOption entity.
     *
     * @Route("/{id}", name="admin_courseoption_delete")
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

        return $this->redirectToRoute('admin_course_asset', array('id' => $courseOption->getCourse()->getId()));
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
            ->setAction($this->generateUrl('admin_courseoption_delete', array('id' => $courseOption->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
