<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Question
 *
 * @ORM\Table(name="ydi_survey_question")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text")
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_code", type="string", length=255, nullable=true)
     */
    private $answerCode;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_hint", type="string", length=1000, nullable=true)
     */
    private $answerHint;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", options={"default" = 0})
     */
    private $position;

    /**
     * @var Survey
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Survey", inversedBy="questions")
     * @ORM\JoinColumn(name="survey_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotNull(message="Survey should not be null.")
     */
    private $survey;

    /**
     * @var Answer[]
     *
     *
     * @ORM\OneToMany(
     *      targetEntity="AppBundle\Entity\Answer",
     *      mappedBy="question",
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     * )
     */
    private $answers;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answerCode
     *
     * @param string $answerCode
     *
     * @return Question
     */
    public function setAnswerCode($answerCode)
    {
        $this->answerCode = $answerCode;

        return $this;
    }

    /**
     * Get answerCode
     *
     * @return string
     */
    public function getAnswerCode()
    {
        return $this->answerCode;
    }

    /**
     * Set answerHint
     *
     * @param string $answerHint
     *
     * @return Question
     */
    public function setAnswerHint($answerHint)
    {
        $this->answerHint = $answerHint;

        return $this;
    }

    /**
     * Get answerHint
     *
     * @return string
     */
    public function getAnswerHint()
    {
        return $this->answerHint;
    }

    /**
     * Set position.
     *
     * @param int $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set survey.
     *
     * @param \AppBundle\Entity\Survey $survey
     *
     * @return $this
     */
    public function setSurvey(\AppBundle\Entity\Survey $survey = null)
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * Get survey.
     *
     * @return \AppBundle\Entity\Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * Add answer.
     *
     * @param \AppBundle\Entity\Answer $answer
     *
     * @return $this
     */
    public function addAnswer(\AppBundle\Entity\Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Remove answer.
     *
     * @param \AppBundle\Entity\Answer $answer
     */
    public function removeAnswer(\AppBundle\Entity\Answer $answer)
    {
        $this->answers->removeElement($answer);
    }

    /**
     * Get answers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}

