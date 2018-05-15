<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Course;
use AppBundle\Entity\CourseParticipant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * UserController.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all course entities.
     *
     * @Route("/course/", name="user_course")
     * @Security("
        has_role('ROLE_WP_SUBSCRIBER')
        or has_role('ROLE_WP_ADMINISTRATOR')
        or has_role('ROLE_WP_CONTRIBUTOR')
    ")
     * @Method("GET")
     *
     * @throws \Exception
     */
    public function courseAction(Request $request, UserInterface $user)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:CourseParticipant')->createQueryBuilder('cp');
        $queryBuilder->where('cp.username = :username')
            ->setParameter('username', $user->getUsername());
        /** @var \Knp\Component\Pager\Paginator $paginator */
        $paginator = $this->get('knp_paginator');
        $paginatedCourses = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('frontend/user/course.html.twig', array(
            'courses' => $paginatedCourses,
        ));
    }
}
