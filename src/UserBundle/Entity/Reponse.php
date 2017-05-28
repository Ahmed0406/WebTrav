<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ReponseRepository")
 */
class Reponse
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $success;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Quiz", inversedBy="reponse")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id", nullable=false)
     */
    private $quiz;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\UserCandidat", inversedBy="reponse")
     * @ORM\JoinColumn(name="user_candidat_id", referencedColumnName="id")
     */
    private $userCandidat;


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
     * Set success
     *
     * @param boolean $success
     *
     * @return Reponse
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Get success
     *
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reponse
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set quiz
     *
     * @param \UserBundle\Entity\Quiz $quiz
     *
     * @return Reponse
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

    /**
     * Set userCandidat
     *
     * @param \UserBundle\Entity\UserCandidat $userCandidat
     *
     * @return Reponse
     */
    public function setUserCandidat(UserCandidat $userCandidat = null)
    {
        $this->userCandidat = $userCandidat;

        return $this;
    }

    /**
     * Get userCandidat
     *
     * @return \UserBundle\Entity\UserCandidat
     */
    public function getUserCandidat()
    {
        return $this->userCandidat;
    }
}
