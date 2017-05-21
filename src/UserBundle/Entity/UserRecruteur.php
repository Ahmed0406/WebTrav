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
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $address1;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $address2;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $state;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zipcode;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Apropos",inversedBy="userRecruteur")
     * @ORM\JoinTable(name="apropos_recruteur",
     *     joinColumns={@ORM\JoinColumn(name="recruteur_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="apropos_id",referencedColumnName="id")})
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
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    /**
     * Add apropos
     *
     * @param \UserBundle\Entity\Apropos $apropos
     *
     * @return UserRecruteur
     */
    public function addApropos(\UserBundle\Entity\Apropos $apropos)
    {
        $this->apropos[] = $apropos;

        return $this;
    }

    /**
     * Remove apropos
     *
     * @param \UserBundle\Entity\Apropos $apropos
     */
    public function removeApropos(Apropos $apropos)
    {
        $this->apropos->removeElement($apropos);
    }

    /**
     * Get \Doctrine\Common\Collections\Collection
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApropos()
    {
        return $this->apropos;
    }

}
