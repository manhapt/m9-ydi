<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Report controller.
 *
 * @Route("report")
 */
class ReportController extends Controller
{
    /**
     * Lists all asset participant.
     *
     * @Route("/{id}", name="admin_report_course")
     * @Method("GET")
     */
    public function courseAction(Request $request, Course $course)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('AppBundle:AssetParticipant')->createCourseReportQB($course);
        $query = $queryBuilder->getQuery();
        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('c.username LIKE :username')
                ->setParameter('username', '%'.$request->query->getAlnum('filter').'%');
        }

        if ($request->query->getAlnum('export')) {
            return $this->generateCsvAction($query->getArrayResult());
        }

        /** @var \Knp\Component\Pager\Paginator $paginator */
        $paginator = $this->get('knp_paginator');
        $paginatedReports = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 20)
        );

        return $this->render('backend/report/course.html.twig', array(
            'course' => $course,
            'users' => $paginatedReports,
        ));
    }

    /**
     * @param array $items
     * @param array $headers
     * @return StreamedResponse
     */
    public function generateCsvAction($items, $headers = [])
    {
        $response = new StreamedResponse();
        $response->setCallback(function() use ($items, $headers) {
            $headers = empty($headers) ? array_keys(reset($items)) : $headers;

            $handle = fopen('php://output', 'w+');
            // Add the header of the CSV file
            fputcsv($handle, $headers,',');
            foreach ($items as $item) {
                $exportRow = [];
                foreach ($headers as $field) {
                    $exportRow[] = $item[$field];
                }
                fputcsv($handle, $exportRow, ',');
            }
            fclose($handle);
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');

        return $response;
    }
}
