<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\QuizRepository")
 */
class Quiz
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
     * @ORM\Column(type="string", nullable=false)
     */
    private $titre;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $tags;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Question", mappedBy="quiz", cascade={"all"}, orphanRemoval=true))
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Reponse", mappedBy="quiz", cascade={"all"}, orphanRemoval=true))
     */
    private $reponse;


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
     * Constructor
     */
    public function __construct()
    {
        $this->question = new ArrayCollection();
        $this->reponse = new ArrayCollection();
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Quiz
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
     * Set tags
     *
     * @param array $tags
     *
     * @return Quiz
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add question
     *
     * @param \UserBundle\Entity\Question $question
     *
     * @return Quiz
     */
    public function addQuestion(Question $question)
    {
        $this->question[] = $question;
        $question->setQuiz($this);

        return $this;
    }

    /**
     * Remove question
     *
     * @param \UserBundle\Entity\Question $question
     */
    public function removeQuestion(Question $question)
    {
        $this->question->removeElement($question);
    }

    /**
     * Get question
     *
     * @return ArrayCollection
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add reponse
     *
     * @param \UserBundle\Entity\Reponse $reponse
     *
     * @return Quiz
     */
    public function addReponse(Reponse $reponse)
    {
        $this->reponse[] = $reponse;

        return $this;
    }

    /**
     * Remove reponse
     *
     * @param \UserBundle\Entity\Reponse $reponse
     */
    public function removeReponse(Reponse $reponse)
    {
        $this->reponse->removeElement($reponse);
    }

    /**
     * Get reponse
     *
     * @return ArrayCollection
     */
    public function getReponse()
    {
        return $this->reponse;
    }
}
