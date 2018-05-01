<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Course;
use AppBundle\Entity\CourseOption;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\FileUploader;

/**
 * Course controller.
 *
 * @Route("course")
 */
class CourseController extends Controller
{
    /**
     * Lists all course entities.
     *
     * @Route("/", name="admin_course_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('AppBundle:Course')->createQueryBuilder('c');
        $query = $queryBuilder->getQuery();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('c.name LIKE :name')
                ->setParameter('name', '%' . $request->query->getAlnum('filter') . '%');
        }

        /** @var \Knp\Component\Pager\Paginator $paginator */
        $paginator = $this->get('knp_paginator');
        $paginatedCourses = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $this->render('backend/course/index.html.twig', array(
            'courses' => $paginatedCourses,
        ));
    }

    /**
     * Creates a new course entity.
     *
     * @Route("/new", name="admin_course_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $course = new Course();
        $form = $this->createForm('AppBundle\Form\CourseType', $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($course->getImage()) {
                $this->uploadFile($course);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();

            return $this->redirectToRoute('admin_course_show', array('id' => $course->getId()));
        }

        return $this->render('backend/course/new.html.twig', array(
            'course' => $course,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a course entity.
     *
     * @Route("/{id}", name="admin_course_show")
     * @Method("GET")
     */
    public function showAction(Course $course)
    {
        $deleteForm = $this->createDeleteForm($course);

        return $this->render('backend/course/show.html.twig', array(
            'course' => $course,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing course entity.
     *
     * @Route("/{id}/edit", name="admin_course_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Course $course)
    {
        $prevImage = $course->getImage();
        if ($prevImage) {
            $course->setImage(new File($this->getParameter('wp_upload_dir').'/'.$prevImage));
        }

        $deleteForm = $this->createDeleteForm($course);
        $editForm = $this->createForm('AppBundle\Form\CourseType', $course);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($course->getImage()) {
                $this->uploadFile($course);
            } else {
                $course->setImage($prevImage);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_course_edit', array('id' => $course->getId()));
        }

        return $this->render('backend/course/edit.html.twig', array(
            'course' => $course,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Add or remove asset from course.
     *
     * @Route("/{id}/asset", name="admin_course_asset")
     * @Method({"GET", "POST"})
     */
    public function assetAction(Request $request, Course $course)
    {
        $em = $this->getDoctrine()->getManager();
        $courseOptions = $em->getRepository('AppBundle:CourseOption')->findBy(
            ['course' => $course],
            ['position' => 'ASC']
        );

        $courseOption = new CourseOption();
        $courseOption->setCourse($course);
        $form = $this->createForm('AppBundle\Form\CourseOptionType', $courseOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($courseOption);
            $em->flush();

            return $this->redirectToRoute('admin_course_edit', array('id' => $course->getId()));
        }

        $deleteForms = [];
        /** @var CourseOption $courseOption */
        foreach ($courseOptions as $courseOption) {
            $deleteForm = $this->createDeleteAssetForm($courseOption);
            $deleteForms[$courseOption->getId()] = $deleteForm->createView();
        }

        return $this->render('backend/course/asset.html.twig', array(
            'courseOptions' => $courseOptions,
            'course' => $course,
            'form' => $form->createView(),
            'deleteAssetForms' => $deleteForms,
        ));
    }

    /**
     * Deletes a course entity.
     *
     * @Route("/{id}", name="admin_course_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Course $course)
    {
        $form = $this->createDeleteForm($course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($course);
            $em->flush();
        }

        return $this->redirectToRoute('admin_course_index');
    }

    /**
     * Creates a form to delete a course entity.
     *
     * @param Course $course The course entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Course $course)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_course_delete', array('id' => $course->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Creates a form to delete a courseOption entity.
     *
     * @param CourseOption $courseOption The courseOption entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteAssetForm(CourseOption $courseOption)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_courseoption_delete', array('id' => $courseOption->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * @param Course $course
     */
    public function uploadFile($course)
    {
        $fileUploader = $this->get('AppBundle\Service\FileUploader');
        $file = $course->getImage();
        $fileName = $fileUploader->upload($file);

        $course->setImage($fileName);
    }
}
