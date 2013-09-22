<?php

namespace Walva\SupportkotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parrain
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Walva\SupportkotBundle\Entity\ParrainRepository")
 */
class Parrain
{
    

    public function __toString() {
        return $this->getPrenom().' '.$this->getNom().' étudiant en '.$this->getFaculte().' '.$this->getAnnee();
    }

    
    public static $MAX_FILLEUL = 4;
    
    
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var Annee
     *
     * @ORM\ManyToOne(targetEntity="Annee")
     */
    private $annee;

    /**
     * @var Fac
     *
     * @ORM\ManyToOne(targetEntity="Fac")
     */
    private $faculte;
    
    /**
     * @var Fac
     *
     * @ORM\OneToMany(targetEntity="Filleul", mappedBy="parrain")
     */
    private $filleuls;
    
    
    



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Parrain
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Parrain
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
     * Set annee
     *
     * @param string $annee
     * @return Parrain
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
     * Set faculte
     *
     * @param string $faculte
     * @return Parrain
     */
    public function setFaculte($faculte)
    {
        $this->faculte = $faculte;
    
        return $this;
    }

    /**
     * Get faculte
     *
     * @return string 
     */
    public function getFaculte()
    {
        return $this->faculte;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filleuls = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add filleuls
     *
     * @param \Walva\SupportkotBundle\Entity\Filleul $filleuls
     * @return Parrain
     */
    public function addFilleul(\Walva\SupportkotBundle\Entity\Filleul $filleuls)
    {
        $this->filleuls[] = $filleuls;
    
        return $this;
    }

    /**
     * Remove filleuls
     *
     * @param \Walva\SupportkotBundle\Entity\Filleul $filleuls
     */
    public function removeFilleul(\Walva\SupportkotBundle\Entity\Filleul $filleuls)
    {
        $this->filleuls->removeElement($filleuls);
    }

    /**
     * Get filleuls
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilleuls()
    {
        return $this->filleuls;
    }
}