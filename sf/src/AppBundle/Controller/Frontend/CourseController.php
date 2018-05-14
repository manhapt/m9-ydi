<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Asset;
use AppBundle\Entity\Course;
use AppBundle\Entity\CourseDecorator;
use AppBundle\Entity\Role;
use AppBundle\Form\RoleTypes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/", name="course_index")
     * @Method("GET")
     * @throws \Exception
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('AppBundle:Course')->createQueryBuilder('c');
        $queryBuilder->select(
            'c.id, c.sku, c.name, c.image, c.description, c.shortDescription, 200 as totalParticipant'
        );
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
            $request->query->getInt('limit', 6)
        );

        return $this->render('frontend/course/index.html.twig', array(
            'courses' => $paginatedCourses,
        ));
    }

    /**
     * Finds and displays a course entity.
     *
     * @Route("/{id}", name="course_show")
     * @Method("GET")
     */
    public function showAction(Request $request, Course $course)
    {
        $em = $this->getDoctrine()->getManager();
        $courseOptions = $em->getRepository('AppBundle:CourseOption')->findBy(
            ['course' => $course],
            ['position' => 'ASC']
        );

        return $this->render('frontend/course/show.html.twig', array(
            'courseOptions' => $courseOptions,
            'course' => $course,
        ));
    }

    /**
     * Finds and displays a course entity.
     *
     * @Route("/{id}/learn", name="course_learn")
     * @Method("GET")
     */
    public function learnAction(Request $request, Course $course)
    {
        $em = $this->getDoctrine()->getManager();
        $courseOptions = $em->getRepository('AppBundle:CourseOption')->findBy(
            ['course' => $course],
            ['position' => 'ASC']
        );

        return $this->render('frontend/course/learn.html.twig', array(
            'courseOptions' => $courseOptions,
            'course' => $course,
        ));
    }

    /**
     * Finds and displays a course entity.
     *
     * @Route("/{id}/asset/{asset_id}", name="course_asset")
     * @ParamConverter("asset", class="AppBundle:Asset", options={"id" = "asset_id"})
     * @Method("GET")
     */
    public function assetAction(Course $course, Asset $asset)
    {
        $em = $this->getDoctrine()->getManager();
        $courseOptions = $em->getRepository('AppBundle:CourseOption')->findBy(
            ['course' => $course],
            ['position' => 'ASC']
        );

        return $this->render('frontend/course/asset.html.twig', array(
            'courseOptions' => $courseOptions,
            'course' => $course,
            'asset' => $asset,
        ));
    }
}
