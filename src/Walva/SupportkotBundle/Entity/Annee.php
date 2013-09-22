<?php

namespace Walva\SupportkotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annee
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Walva\SupportkotBundle\Entity\AnneeRepository")
 */
class Annee
{
    public static $COULEUR_GRIS = 1;
    public static $COULEUR_VERT = 2;
    public static $COULEUR_ORANGE = 3;
    public static $COULEUR_ROUGE = 4;
    public static $COULEUR_BLEU = 5;
    public static $COULEUR_NOIR = 6;
    
    public function __toString() {
        return $this->getNom();
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;


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
     * @return Annee
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
     * Set couleur
     *
     * @param string $couleur
     * @return Annee
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;
    
        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur()
    {
        return $this->couleur;
    }
}