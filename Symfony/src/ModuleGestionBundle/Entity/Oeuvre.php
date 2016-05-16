<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Oeuvre
 */
class Oeuvre
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $imgFlashcode;

    /**
     * @var string
     */
    private $etat;

    /**
     * @var int
     */
    private $nombreVisite;

    /**
     * @ORM\OneToMany(targetEntity="TexteOeuvre", mappedBy="oeuvre")
     */
    private $texteoeuvres;

    /**
     * @ORM\ManyToOne(targetEntity="Emplacement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $emplacement;

    public function __construct()
    {
        $this->texteoeuvres = new ArrayCollection();
    }

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
     * Set imgFlashcode
     *
     * @param string $imgFlashcode
     *
     * @return Oeuvre
     */
    public function setImgFlashcode($imgFlashcode)
    {
        $this->imgFlashcode = $imgFlashcode;
    
        return $this;
    }

    /**
     * Get imgFlashcode
     *
     * @return string
     */
    public function getImgFlashcode()
    {
        return $this->imgFlashcode;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Oeuvre
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set nombreVisite
     *
     * @param integer $nombreVisite
     *
     * @return Oeuvre
     */
    public function setNombreVisite($nombreVisite)
    {
        $this->nombreVisite = $nombreVisite;
    
        return $this;
    }

    /**
     * Get nombreVisite
     *
     * @return integer
     */
    public function getNombreVisite()
    {
        return $this->nombreVisite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Oeuvre
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
     * Add texteoeuvre
     *
     * @param \ModuleGestionBundle\Entity\TexteOeuvre $texteoeuvre
     *
     * @return Oeuvre
     */
    public function addTexteoeuvre(\ModuleGestionBundle\Entity\TexteOeuvre $texteoeuvre)
    {
        $this->texteoeuvres[] = $texteoeuvre;
    
        return $this;
    }

    /**
     * Remove texteoeuvre
     *
     * @param \ModuleGestionBundle\Entity\TexteOeuvre $texteoeuvre
     */
    public function removeTexteoeuvre(\ModuleGestionBundle\Entity\TexteOeuvre $texteoeuvre)
    {
        $this->texteoeuvres->removeElement($texteoeuvre);
    }

    /**
     * Get texteoeuvres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTexteoeuvres()
    {
        return $this->texteoeuvres;
    }

    /**
     * Set emplacement
     *
     * @param \ModuleGestionBundle\Entity\Emplacement $emplacement
     *
     * @return Oeuvre
     */
    public function setEmplacement(\ModuleGestionBundle\Entity\Emplacement $emplacement)
    {
        $this->emplacement = $emplacement;
    
        return $this;
    }

    /**
     * Get emplacement
     *
     * @return \ModuleGestionBundle\Entity\Emplacement
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }
}
