<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Asset;
use AppBundle\Entity\Course;
use AppBundle\Entity\CourseParticipant;
use AppBundle\Event\AssetLoadEvent;
use AppBundle\Repository\CourseRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

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
     *
     * @throws \Exception
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var CourseRepository $courseRepository */
        $courseRepository = $em->getRepository('AppBundle:Course');

        $queryBuilder = $courseRepository->getCourseListQueryBuilder();
        $queryBuilder->orderBy('c.modified', 'DESC');
        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('c.name LIKE :name')
                ->setParameter('name', '%'.$request->query->getAlnum('filter').'%');
        }

        /** @var \Knp\Component\Pager\Paginator $paginator */
        $paginator = $this->get('knp_paginator');
        $paginatedCourses = $paginator->paginate(
            $queryBuilder->getQuery(),
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
     * @Security("
           has_role('ROLE_WP_SUBSCRIBER')
        or has_role('ROLE_WP_ADMINISTRATOR')
        or has_role('ROLE_WP_CONTRIBUTOR')
     ")
     * @Method("GET")
     */
    public function learnAction(Course $course)
    {
        $token = $this->get('security.token_storage')->getToken();
        $this->registerCourseParticipant($token->getUser(), $course);

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
        $this->preloadAsset($asset);
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

    /**
     * @param UserInterface $user
     * @param Course        $course
     */
    private function registerCourseParticipant(UserInterface $user, Course $course)
    {
        $em = $this->getDoctrine()->getManager();
        $joinStatus = $em->getRepository('AppBundle:CourseParticipant')->findOneBy([
            'username' => $user->getUsername(),
            'course' => $course,
        ]);

        if (null === $joinStatus) {
            $em->persist(
                (new CourseParticipant())
                    ->setCourse($course)
                    ->setUsername($user->getUsername())
            );
            $em->flush();
        }
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
