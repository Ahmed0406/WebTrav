<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var Image
     *
     * @ORM\OneToOne(targetEntity="Image",cascade={"persist"})
     */
    private $imgcover;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\CV", mappedBy="userCandidat",cascade={"persist"})
     */
    private $cV;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Reponse", mappedBy="userCandidat")
     */
    private $reponse;


    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_CANDIDAT');
        $this->reponse = new ArrayCollection();
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
     * Set imgcover
     *
     * @param Image $imgcover
     *
     * @return UserCandidat
     */
    public function setImgcover(Image $imgcover = null)
    {
        $this->imgcover = $imgcover;

        return $this;
    }

    /**
     * Get imgcover
     *
     * @return Image
     */
    public function getImgcover()
    {
        return $this->imgcover;
    }

    /**
     * Set cV
     *
     * @param \UserBundle\Entity\CV $cV
     *
     * @return UserCandidat
     */
    public function setCV(CV $cV = null)
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


    /**
     * Add reponse
     *
     * @param \UserBundle\Entity\Reponse $reponse
     *
     * @return UserCandidat
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponse()
    {
        return $this->reponse;
    }
}
