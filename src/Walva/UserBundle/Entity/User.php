<?php

namespace Walva\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use \Walva\SupportkotBundle\Entity\Parrain;
use Walva\SupportkotBundle\Entity\Filleul;

/**
 * User
 *
 * @ORM\Table(name="supportkot_user")
 * @ORM\Entity(repositoryClass="Walva\UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser {

    /**
     * @ORM\PrePersist
     */
    public function validate(){
        $parrain = $this->getParrain();
        $filleul = $this->getFilleul();
        if(!isset($parrain) OR !isset($filleul)){
            return;
        }
        $parrainNom = $this->getParrain()->getNom();
        $parrainPrenom = $this->getParrain()->getPrenom();
        $filleulNom = $this->getFilleul()->getNom();
        $filleulPrenom = $this->getFilleul()->getPrenom();
        if(!isset($parrainNom) && !isset($parrainPrenom)){
            $this->setParrain (null);
        }
        if(!isset($filleulNom) && !isset($filleulPrenom)){
            $this->setFilleul(null);
        }
    }
    
    public static $_TYPE_PARRAN = 'parrain';
    public static $_TYPE_FILLEUL = 'filleul';
    public static $_TYPE_ADMIN = 'admin';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\OneToOne(targetEntity="Walva\SupportkotBundle\Entity\Parrain", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $parrain;

    /**
     * @var Walva\SupportkotBundle\Entity\Filleul
     *
     * @ORM\OneToOne(targetEntity="Walva\SupportkotBundle\Entity\Filleul", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $filleul;

    public function __construct() {
        parent::__construct();
        $this->setParrain(new Parrain());
        $this->setFilleul(new Filleul());
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @param type sring
     * @return \Walva\UserBundle\Entity\User
     */
    public function setEmail($email) {
        $this->email = $email;
        $this->setUsername($email);
        return $this;
    }


    /**
     * Set parrain
     *
     * @param \Walva\SupportkotBundle\Entity\Parrain $parrain
     * @return User
     */
    public function setParrain(\Walva\SupportkotBundle\Entity\Parrain $parrain = null)
    {
        $this->parrain = $parrain;
    
        return $this;
    }

    /**
     * Get parrain
     *
     * @return \Walva\SupportkotBundle\Entity\Parrain 
     */
    public function getParrain()
    {
        return $this->parrain;
    }

    /**
     * Set filleul
     *
     * @param \Walva\SupportkotBundle\Entity\Filleul $filleul
     * @return User
     */
    public function setFilleul(\Walva\SupportkotBundle\Entity\Filleul $filleul = null)
    {
        $this->filleul = $filleul;
    
        return $this;
    }

    /**
     * Get filleul
     *
     * @return \Walva\SupportkotBundle\Entity\Filleul 
     */
    public function getFilleul()
    {
        return $this->filleul;
    }
}