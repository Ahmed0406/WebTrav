<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\FormationRepository")
 */
class Formation
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
    private $scolarite;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $diplome;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\CV", inversedBy="formation")
     * @ORM\JoinColumn(name="cv_id", referencedColumnName="id", nullable=false)
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
     * Set scolarite
     *
     * @param string $scolarite
     *
     * @return Formation
     */
    public function setScolarite($scolarite)
    {
        $this->scolarite = $scolarite;

        return $this;
    }

    /**
     * Get scolarite
     *
     * @return string
     */
    public function getScolarite()
    {
        return $this->scolarite;
    }

    /**
     * Set diplome
     *
     * @param string $diplome
     *
     * @return Formation
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome
     *
     * @return string
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * Set annee
     *
     * @param string $annee
     *
     * @return Formation
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set cV
     *
     * @param \UserBundle\Entity\CV $cV
     *
     * @return Formation
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
