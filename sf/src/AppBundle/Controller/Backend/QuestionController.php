<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Answer;
use AppBundle\Entity\Asset;
use AppBundle\Entity\Question;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Question controller.
 *
 * @Route("question")
 */
class QuestionController extends Controller
{
    /**
     * Lists all question entities.
     *
     * @Route("/", name="admin_question_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $questions = $em->getRepository('AppBundle:Question')->findAll();

        return $this->render('question/index.html.twig', array(
            'questions' => $questions,
        ));
    }

    /**
     * Creates a new question entity.
     *
     * @Route("/new", name="admin_question_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $question = new Question();
        $question->addAnswer(new Answer());
        $form = $this->createForm('AppBundle\Form\QuestionType', $question);
        $form->handleRequest($request);

        /** @var Answer $answer */
        foreach ($question->getAnswers() as $idx => $answer) {
            $answer->setPosition($idx+1);
            $answer->setCode($this->encodeText($answer->getAnswer()));
            $answer->setQuestion($question);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('admin_question_edit', array('id' => $question->getId()));
        }

        return $this->render('backend/question/new.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a question entity.
     *
     * @Route("/{id}", name="admin_question_show")
     * @Method("GET")
     */
    public function showAction(Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);

        return $this->render('question/show.html.twig', array(
            'question' => $question,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing question entity.
     *
     * @Route("/{id}/edit", name="admin_question_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Question $question)
    {
        $originalAnswers = new ArrayCollection();

        // Create an ArrayCollection of the current Answer objects in the database
        /** @var Answer $answer */
        foreach ($question->getAnswers() as $answer) {
            $answer->setQuestion($question);
            $originalAnswers->add($answer);
        }

        $editForm = $this->createForm('AppBundle\Form\QuestionType', $question);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /** @var Answer $answer */
            foreach ($question->getAnswers() as $idx => $answer) {
                $answer->setPosition($idx+1);
                $answer->setCode($this->encodeText($answer->getAnswer()));
                $answer->setQuestion($question);
            }

            // remove the relationship between the answer and the Question
            /** @var Answer $answer */
            foreach ($originalAnswers as $answer) {
                if (false === $question->getAnswers()->contains($answer)) {
                    // remove the Question from the Answer
                    $answer->setQuestion(null);
                    $this->getDoctrine()->getManager()->remove($answer);
                }
            }

            $this->getDoctrine()->getManager()->persist($question);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_question_edit', array('id' => $question->getId()));
        }

        $deleteForm = $this->createDeleteForm($question);

        return $this->render('backend/question/edit.html.twig', array(
            'question' => $question,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Up/Down position of question
     *
     * @Route("/{id}/up", name="admin_question_up")
     * @Method({"GET"})
     */
    public function upAction(Request $request, Question $question)
    {
        $existingQuestions = [];
        foreach ($question->getSurvey()->getQuestions() as $existingQuestion) {
            $existingQuestions[] = $existingQuestion;
        }

        usort($existingQuestions, function($a, $b) {
            return $a->getPosition() <=> $b->getPosition();
        });

        /** @var Question $existingQuestion */
        foreach ($existingQuestions as $idx => $existingQuestion) {
            $existingQuestion->setPosition($idx+1);
        }

        /** @var Question $existingQuestion */
        foreach ($existingQuestions as $existingQuestion) {
            /** @var Question $upItem */
            $upItem = $upItem ?? null;
            if ($question->getId() == $existingQuestion->getId()) {
                if ($upItem) {
                    $upItem->setPosition($upItem->getPosition() + 1);
                    $existingQuestion->setPosition($existingQuestion->getPosition() -1 );
                }
                break;
            } else {
                $upItem = $existingQuestion;
            }

            $this->getDoctrine()->getManager()->persist($existingQuestion);
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_survey_edit', array('id' => $question->getSurvey()->getId()));
    }

    /**
     * Deletes a question entity.
     *
     * @Route("/{id}", name="admin_question_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Question $question)
    {
        $surveyId = $question->getSurvey()->getId();
        $form = $this->createDeleteForm($question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($question);
            $em->flush();
        }

        return $this->redirectToRoute('admin_survey_edit', array('id' => $surveyId));
    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_question_delete', array('id' => $question->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param $text
     * @return string
     */
    private function encodeText($text)
    {
        return strtoupper(hash('adler32', $text));
    }
}
