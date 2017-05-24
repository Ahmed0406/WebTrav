<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ExperienceRepository")
 */
class Experience
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
    private $description;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\CV", inversedBy="experience")
     * @ORM\JoinColumn(name="cv_id", referencedColumnName="id")
     */
    private $cV;

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
     * @return Experience
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
     * Set description
     *
     * @param string $description
     *
     * @return Experience
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return Experience
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set cV
     *
     * @param \UserBundle\Entity\CV $cV
     *
     * @return Experience
     */
    public function setCV(\UserBundle\Entity\CV $cV)
    {
        $this->cV = $cV;

        return $this;
    }

    /**
     * Get cV
     *
     * @return \UserBundle\Entity\CV
     */
    public function getCV()
    {
        return $this->cV;
    }
}
