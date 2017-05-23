<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_recruteur")
 * @UniqueEntity(fields = "username", targetClass = "UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class UserRecruteur extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @var Apropos
     * @ORM\OneToOne(targetEntity="Apropos",cascade={"persist"})
     */
    private $apropos;


    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_RECRUTEUR');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set apropos
     *
     * @param Apropos $apropos
     *
     * @return UserRecruteur
     */
    public function setApropos(Apropos $apropos = null)
    {
        $this->apropos = $apropos;

        return $this;
    }

    /**
     * Get apropos
     *
     * @return Apropos
     */
    public function getApropos()
    {
        return $this->apropos;
    }
}
