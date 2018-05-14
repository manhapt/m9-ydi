<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Course;
use AppBundle\Entity\CourseDecorator;
use AppBundle\Entity\Role;
use AppBundle\Form\RoleTypes;
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
    public function showAction(Course $course)
    {
        return $this->render('frontend/course/show.html.twig', array(
            'course' => $course,
        ));
    }
}
