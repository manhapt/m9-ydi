<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Course;
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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contributorRole = $em->getRepository('AppBundle:Role')->findOneBy(
            ['resource' => 'course', 'name' => RoleTypes::CONTRIBUTOR]
        );
        $subscriberRole = $em->getRepository('AppBundle:Role')->findOneBy(
            ['resource' => 'course', 'name' => RoleTypes::SUBSCRIBER]
        );

        if (!$contributorRole || !$subscriberRole) {
            throw new \Exception(
                RoleTypes::CONTRIBUTOR . ' and ' . RoleTypes::SUBSCRIBER
                . ' with "course" resource are required!'
            );
        }

        $contributorCourses = [];
        $subscriberCourses = [];
        /** @var Course $course */
        foreach ($em->getRepository('AppBundle:Course')->findAll() as $course) {
            /** @var Role $role */
            foreach ($course->getRoles() as $role) {
                if ($role->getId() === $contributorRole->getId()) {
                    $contributorCourses[] = $course;
                }
                if ($role->getId() === $subscriberRole->getId()) {
                    $subscriberCourses[] = $course;
                }

                if (count($contributorCourses) > 9 && count($subscriberCourses) > 9 ) {
                    break;
                }
            }
        }

        return $this->render('frontend/course/index.html.twig', array(
            'contributorCourses' => $contributorCourses,
            'subscriberCourses' => $subscriberCourses,
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
