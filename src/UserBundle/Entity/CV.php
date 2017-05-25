<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CV
 *
 * @ORM\Table(name="cv")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\CVRepository")
 */
class CV
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
     * @ORM\Column(type="array", nullable=true)
     */
    private $competence;

    /**
 * @ORM\Column(type="array", nullable=true)
 */
    private $langue;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\UserCandidat", inversedBy="cV", cascade={"all"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="cv_candidat_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $userCandidat;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Experience", mappedBy="cV", cascade={"all"}, orphanRemoval=true))
     */
    protected $experience;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Formation", mappedBy="cV", cascade={"all"}, orphanRemoval=true))
     */
    protected $formation;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Projet", mappedBy="cV", cascade={"all"}, orphanRemoval=true))
     */
    protected $projet;

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
     * Set competence
     *
     * @param array $competence
     *
     * @return CV
     */
    public function setCompetence($competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return array
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Set langue
     *
     * @param array $langue
     *
     * @return CV
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return array
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set userCandidat
     *
     * @param \UserBundle\Entity\UserCandidat $userCandidat
     *
     * @return CV
     */
    public function setUserCandidat(\UserBundle\Entity\UserCandidat $userCandidat)
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->experience = new ArrayCollection();
        $this->formation = new ArrayCollection();
        $this->projet = new ArrayCollection();
    }

    /**
     * Add experience
     *
     * @param \UserBundle\Entity\Experience $experience
     *
     * @return CV
     */
    public function addExperience(\UserBundle\Entity\Experience $experience)
    {
        $this->experience[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \UserBundle\Entity\Experience $experience
     */
    public function removeExperience(\UserBundle\Entity\Experience $experience)
    {
        $this->experience->removeElement($experience);
    }

    /**
     * Get experience
     *
     * @return ArrayCollection
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Add formation
     *
     * @param \UserBundle\Entity\Formation $formation
     *
     * @return CV
     */
    public function addFormation(\UserBundle\Entity\Formation $formation)
    {
        $this->formation[] = $formation;

        return $this;
    }

    /**
     * Remove formation
     *
     * @param \UserBundle\Entity\Formation $formation
     */
    public function removeFormation(\UserBundle\Entity\Formation $formation)
    {
        $this->formation->removeElement($formation);
    }

    /**
     * Get formation
     *
     * @return ArrayCollection
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Add projet
     *
     * @param \UserBundle\Entity\Projet $projet
     *
     * @return CV
     */
    public function addProjet(\UserBundle\Entity\Projet $projet)
    {
        $this->projet[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param \UserBundle\Entity\Projet $projet
     */
    public function removeProjet(\UserBundle\Entity\Projet $projet)
    {
        $this->projet->removeElement($projet);
    }

    /**
     * Get projet
     *
     * @return ArrayCollection
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
