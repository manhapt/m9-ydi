<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Asset;
use AppBundle\Entity\Question;
use AppBundle\Entity\Survey;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Survey controller.
 *
 * @Route("survey")
 */
class SurveyController extends Controller
{
    /**
     * Creates a new survey entity.
     *
     * @Route("/new", name="admin_survey_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $survey = new Survey();
        $form = $this->createForm('AppBundle\Form\SurveyType', $survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $asset = new Asset();
            $asset->setUuid(strtoupper(hash('adler32', uniqid(rand(), true))));
            $asset->setTitle($survey->getName());
            $asset->setDescription($survey->getDescription());
            $survey->setAsset($asset);
            $asset->setSurvey($survey);
            $em->persist($asset);
            $em->persist($survey);
            $em->flush();

            return $this->redirectToRoute('admin_survey_question', array('id' => $survey->getId()));
        }

        return $this->render('backend/survey/new.html.twig', array(
            'survey' => $survey,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing survey entity.
     *
     * @Route("/{id}/edit", name="admin_survey_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Survey $survey)
    {
        $deleteForm = $this->createDeleteForm($survey);
        $editForm = $this->createForm('AppBundle\Form\SurveyType', $survey);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $asset = $survey->getAsset();
            $asset->setTitle($survey->getName());
            $asset->setDescription($survey->getDescription());

            $this->getDoctrine()->getManager()->persist($asset);
            $this->getDoctrine()->getManager()->persist($survey);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_survey_edit', array('id' => $survey->getId()));
        }

        $deleteForms = [];
        $sortedQuestions = [];
        /** @var Question $question */
        foreach ($survey->getQuestions() as $question) {
            $sortedQuestions[] = $question;
            $deleteForm = $this->createDeleteQuestionForm($question);
            $deleteForms[$question->getId()] = $deleteForm->createView();
        }

        usort($sortedQuestions, function($a, $b) {
            /** @var Question $a */
            /** @var Question $b */
            return $a->getPosition() <=> $b->getPosition();
        });

        return $this->render('backend/survey/edit.html.twig', array(
            'survey' => $survey,
            'questions' => $sortedQuestions,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'deleteQuestionForms' => $deleteForms,
        ));
    }

    /**
     * Add or remove question from survey.
     *
     * @Route("/{id}/question", name="admin_survey_question")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Survey $survey
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function questionAction(Request $request, Survey $survey)
    {
        $question = new Question();
        $question->addAnswer(new Answer());
        $question->setPosition($survey->getQuestions()->count()+1);
        $survey->addQuestion($question);
        $form = $this->createForm('AppBundle\Form\QuestionType', $question);
        $form->handleRequest($request);

        /** @var Answer $answer */
        foreach ($question->getAnswers() as $idx => $answer) {
            $answer->setPosition($idx+1);
            $answer->setQuestion($question);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->persist($survey);
            $em->flush();

            return $this->redirectToRoute('admin_question_edit', array('id' => $question->getId()));
        }

        return $this->render('backend/question/new.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a survey entity.
     *
     * @Route("/{id}", name="admin_survey_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Survey $survey)
    {
        $form = $this->createDeleteForm($survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($survey);
            $em->flush();
        }

        return $this->redirectToRoute('admin_survey_index');
    }

    /**
     * Creates a form to delete a survey entity.
     *
     * @param Survey $survey The survey entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Survey $survey)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_survey_delete', array('id' => $survey->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteQuestionForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_question_delete', array('id' => $question->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
