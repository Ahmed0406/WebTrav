<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\QuestionRepository")
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $reponce;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $chnce;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Quiz", inversedBy="question")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id", nullable=false)
     */
    private $quiz;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Question
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set reponce
     *
     * @param string $reponce
     *
     * @return Question
     */
    public function setReponce($reponce)
    {
        $this->reponce = $reponce;

        return $this;
    }

    /**
     * Get reponce
     *
     * @return string
     */
    public function getReponce()
    {
        return $this->reponce;
    }

    /**
     * Set chnce
     *
     * @param array $chnce
     *
     * @return Question
     */
    public function setChnce($chnce)
    {
        $this->chnce = $chnce;

        return $this;
    }

    /**
     * Get chnce
     *
     * @return array
     */
    public function getChnce()
    {
        return $this->chnce;
    }

    /**
     * Set quiz
     *
     * @param \UserBundle\Entity\Quiz $quiz
     *
     * @return Question
     */
    public function setQuiz(Quiz $quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz
     *
     * @return \UserBundle\Entity\Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
}
