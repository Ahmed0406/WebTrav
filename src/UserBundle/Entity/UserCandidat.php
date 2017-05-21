<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_candidat")
 * @UniqueEntity(fields = "username", targetClass = "UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class UserCandidat extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $address1;

    /**
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
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Image",cascade={"persist"})
     */
    private $imgcover;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->roles = array('ROLE_CANDIDAT');
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }



    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return UserCandidat
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set address1
     *
     * @param string $address1
     *
     * @return UserCandidat
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     *
     * @return UserCandidat
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return UserCandidat
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return UserCandidat
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zipcode
     *
     * @param integer $zipcode
     *
     * @return UserCandidat
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return integer
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return UserCandidat
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set imgcover
     *
     * @param \UserBundle\Entity\Image $imgcover
     *
     * @return UserCandidat
     */
    public function setImgcover(\UserBundle\Entity\Image $imgcover = null)
    {
        $this->imgcover = $imgcover;

        return $this;
    }

    /**
     * Get imgcover
     *
     * @return \UserBundle\Entity\Image
     */
    public function getImgcover()
    {
        return $this->imgcover;
    }
}
