<?php

namespace Walva\SupportkotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filleul
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Walva\SupportkotBundle\Entity\FilleulRepository")
 */
class Filleul
{
    public function __toString() {
        return $this->getPrenom().' '.$this->getNom().' étudiant en '.$this->getFaculte().' '.$this->getAnnee();
    }

    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Annee
     *
     * @ORM\ManyToOne(targetEntity="Annee")
     */
    private $annee;

    /**
     * @var Parrain
     *
     * @ORM\ManyToOne(targetEntity="Parrain", inversedBy="filleuls"))
     */
    private $parrain;

    /**
     * @var Fac
     *
     * @ORM\ManyToOne(targetEntity="Fac")
     */
    private $faculte;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set annee
     *
     * @param \stdClass $annee
     * @return Filleul
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    
        return $this;
    }

    /**
     * Get annee
     *
     * @return \stdClass 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set faculte
     *
     * @param \stdClass $faculte
     * @return Filleul
     */
    public function setFaculte($faculte)
    {
        $this->faculte = $faculte;
    
        return $this;
    }

    /**
     * Get faculte
     *
     * @return \stdClass 
     */
    public function getFaculte()
    {
        return $this->faculte;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Filleul
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
     * @return Filleul
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
     * Set parrain
     *
     * @param \Walva\SupportkotBundle\Entity\Parrain $parrain
     * @return Filleul
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
}