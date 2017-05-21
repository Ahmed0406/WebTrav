<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Form\UserRecruteurType;

/**
 * Apropos
 *
 * @ORM\Table(name="apropos")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\AproposRepository")
 */
class Apropos
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
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\UserRecruteur",mappedBy="apropos")
     */
    private $userRecruteur;
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
     * @return Apropos
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
     * @return Apropos
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
     * Constructor
     */
    public function __construct()
    {
        $this->userRecruteur = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add userRecruteur
     *
     * @param \UserBundle\Entity\UserRecruteur $userRecruteur
     *
     * @return Apropos
     */
    public function addUserRecruteur(\UserBundle\Entity\UserRecruteur $userRecruteur)
    {
        $this->userRecruteur[] = $userRecruteur;

        return $this;
    }

    /**
     * Remove userRecruteur
     *
     * @param \UserBundle\Entity\UserRecruteur $userRecruteur
     */
    public function removeUserRecruteur(\UserBundle\Entity\UserRecruteur $userRecruteur)
    {
        $this->userRecruteur->removeElement($userRecruteur);
    }

    /**
     * Get userRecruteur
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRecruteur()
    {
        return $this->userRecruteur;
    }
}
