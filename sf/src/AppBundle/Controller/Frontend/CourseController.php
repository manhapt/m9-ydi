<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Asset;
use AppBundle\Entity\AssetParticipant;
use AppBundle\Entity\Course;
use AppBundle\Entity\CourseParticipant;
use AppBundle\Event\AssetLoadEvent;
use AppBundle\Form\RoleTypes;
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


        /** @var CourseRepository $courseRepository */
        $qb = $em->getRepository('AppBundle:Course')->getCourseListQueryBuilder();
        $qb->innerJoin('c.roles', 'role')
            ->where('role.id = :role_id');

        $contributorCourses = $qb->setParameter('role_id', $contributorRole->getId())->getQuery()->getResult();
        $subscriberCourses = $qb->setParameter('role_id', $subscriberRole->getId())->getQuery()->getResult();

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
    public function showAction(Request $request, Course $course)
    {
        $em = $this->getDoctrine()->getManager();
        $token = $this->get('security.token_storage')->getToken();
        if ($token && $token->getUser() instanceof \Ekino\WordpressBundle\Entity\User) {
            $joinStatus = $em->getRepository('AppBundle:CourseParticipant')->findOneBy([
                'username' => $token->getUser()->getUsername(),
                'course' => $course,
            ]);
            if ($joinStatus) {
                return $this->redirectToRoute('course_learn', array('id' => $course->getId()));
            }
        }

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
     * @Security("
        has_role('ROLE_WP_SUBSCRIBER')
        or has_role('ROLE_WP_ADMINISTRATOR')
        or has_role('ROLE_WP_CONTRIBUTOR')
    ")
     * @ParamConverter("asset", class="AppBundle:Asset", options={"id" = "asset_id"})
     * @Method("GET")
     */
    public function assetAction(Course $course, Asset $asset)
    {
        $this->preloadAsset($asset);
        $token = $this->get('security.token_storage')->getToken();
        $em = $this->getDoctrine()->getManager();
        $courseOptions = $em->getRepository('AppBundle:CourseOption')->findBy(
            ['course' => $course],
            ['position' => 'ASC']
        );

        $assetParticipants = $em->getRepository('AppBundle:AssetParticipant')
            ->findLearnedAssetsInCourse($course, $token->getUser());
        $completedAssets = [];
        foreach ($courseOptions as $courseOption) {
            foreach ($courseOption->getAssets() as $courseAsset) {
                /** @var AssetParticipant $assetParticipant */
                foreach ($assetParticipants as $assetParticipant) {
                    /** @var Asset $learnedAsset */
                    $learnedAsset = $assetParticipant->getAsset();
                    if ($learnedAsset && $learnedAsset->getId() == $courseAsset->getId()) {
                        $completedAssets[] = $courseAsset;
                    }
                }
            }
        }
        
        $response = $this->render('frontend/course/asset.html.twig', array(
            'courseOptions' => $courseOptions,
            'course' => $course,
            'asset' => $asset,
            'learnedAssets' => $completedAssets,
        ));

        $this->registerAssetParticipant($token->getUser(), $asset, $course);

        return $response;
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
     * @param UserInterface $user
     * @param Asset $asset
     * @param Course $course
     */
    private function registerAssetParticipant(UserInterface $user, Asset $asset, Course $course)
    {
        $em = $this->getDoctrine()->getManager();
        $joinStatus = $em->getRepository('AppBundle:AssetParticipant')->findOneBy([
            'courseId' => $course->getId(),
            'username' => $user->getUsername(),
            'asset' => $asset,
        ]);

        if (null === $joinStatus) {
            $em->persist(
                (new AssetParticipant())
                    ->setCourseId($course->getId())
                    ->setAsset($asset)
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
