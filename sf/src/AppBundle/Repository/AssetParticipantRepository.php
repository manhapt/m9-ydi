<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Course;
use AppBundle\Entity\CourseOption;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * AssetParticipantRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AssetParticipantRepository extends \Doctrine\ORM\EntityRepository
{
    public function findLearnedAssetsInCourse(Course $course, UserInterface $user)
    {
        return $this->findBy([
            'username' => $user->getUsername(),
            'courseId' => $course->getId(),
        ]);
    }

    /**
     * Run this command in MySQL 5.7 to fix error "incompatible with sql_mode=only_full_group_by""
     * SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));
     *
     * @param Course $course
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createCourseReportQB(Course $course)
    {
        $currentCourseAssets = [];
        /** @var CourseOption $courseOption */
        foreach ($course->getCourseOptions() as $courseOption) {
            foreach ($courseOption->getAssets() as $asset) {
                $currentCourseAssets[] = $asset;
            }
        }
        $queryBuilder = $this->createQueryBuilder('c');
        $queryBuilder
            ->select('
                c.username, u.email, u.displayName as name
                ,(COUNT(c.asset)/'.count($currentCourseAssets).'*100) AS complete
            ')
            ->innerJoin('EkinoWordpressBundle:User', 'u', 'WITH', 'u.login=c.username')
            ->where('c.courseId = :courseId')
            ->setParameter('courseId', $course->getId())
            ->andWhere('c.asset IN (:assets)')
            ->setParameter('assets', $currentCourseAssets)
            ->groupBy('c.username')
            ->orderBy('c.username', 'ASC')
        ;

        return $queryBuilder;
    }
}
