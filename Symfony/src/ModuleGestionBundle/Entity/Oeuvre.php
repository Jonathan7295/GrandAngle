<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Oeuvre
 *
 * @ORM\Table(name="oeuvre")
 * @ORM\Entity(repositoryClass="ModuleGestionBundle\Repository\OeuvreRepository")
 */
class Oeuvre
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="imgFlashcode", type="string", length=255, nullable=true)
     */
    private $imgFlashcode;

    /**
     * @ORM\Column(name="genFlashcode", type="boolean", nullable=true)
     */
     private $genFlashcode;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreVisite", type="integer", nullable=true)
     */
    private $nombreVisite;

     /**
     * @ORM\OneToMany(targetEntity="TexteOeuvre", mappedBy="oeuvre", cascade={"persist","remove"})
     */
    private $texteoeuvres;

    /**
     * @ORM\OneToMany(targetEntity="Emplacement", mappedBy="oeuvre", cascade={"persist","remove"})
     */
    public $emplacements;

    /**
     * @ORM\ManyToOne(targetEntity="Artiste", inversedBy="oeuvres", cascade={"persist"})
     * @ORM\JoinColumn(name="artiste_id", referencedColumnName="id")
     */
    private $artiste;

    /**
     * @ORM\OneToMany(targetEntity="Multimedia", mappedBy="oeuvre", cascade={"persist"})
     */
    private $multimedias;

    /**
     * @ORM\ManyToOne(targetEntity="TypeOeuvre")
     * @ORM\JoinColumn(name="typeoeuvre", referencedColumnName="id")
     */
    private $typeoeuvre;

    public function __construct()
    {
        $this->texteoeuvres = new ArrayCollection();
        $this->emplacements = new ArrayCollection();
        $this->multimedias = new ArrayCollection();
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
     * Set genFlashcode
     *
     * @param boolean $genFlashcode
     *
     * @return Oeuvre
     */
    public function setGenFlashcode($genFlashcode)
    {
        $this->genFlashcode = $genFlashcode;
    
        return $this;
    }

    /**
     * Get genFlashcode
     *
     * @return boolean
     */
    public function getGenFlashcode()
    {
        return $this->genFlashcode;
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
     * Add texteoeuvre
     *
     * @param \ModuleGestionBundle\Entity\TexteOeuvre $texteoeuvre
     *
     * @return Oeuvre
     */
    public function addTexteoeuvre(\ModuleGestionBundle\Entity\TexteOeuvre $texteoeuvre)
    {
        $texteoeuvre->setOeuvre($this);

        $this->texteoeuvres->add($texteoeuvre);
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
     * Add emplacement
     *
     * @param \ModuleGestionBundle\Entity\Emplacement $emplacement
     *
     * @return Oeuvre
     */
    public function addEmplacement(\ModuleGestionBundle\Entity\Emplacement $emplacement)
    {
        $emplacement->setOeuvre($this);

        $this->emplacements->add($emplacement);
    }

    /**
     * Remove emplacement
     *
     * @param \ModuleGestionBundle\Entity\Emplacement $emplacement
     */
    public function removeEmplacement(\ModuleGestionBundle\Entity\Emplacement $emplacement)
    {
        $this->emplacements->removeElement($emplacement);
    }

    /**
     * Get emplacements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmplacements()
    {
        return $this->emplacements;
    }

    /**
     * Set artiste
     *
     * @param \ModuleGestionBundle\Entity\Artiste $artiste
     *
     * @return Oeuvre
     */
    public function setArtiste(\ModuleGestionBundle\Entity\Artiste $artiste = null)
    {
        $this->artiste = $artiste;
    
        return $this;
    }

    /**
     * Get artiste
     *
     * @return \ModuleGestionBundle\Entity\Artiste
     */
    public function getArtiste()
    {
        return $this->artiste;
    }

    /**
     * Add multimedia
     *
     * @param \ModuleGestionBundle\Entity\Multimedia $multimedia
     *
     * @return Oeuvre
     */
    public function addMultimedia(\ModuleGestionBundle\Entity\Multimedia $multimedia)
    {
        $multimedia->setOeuvre($this);

        $this->multimedias->add($multimedia);
    }

    /**
     * Remove multimedia
     *
     * @param \ModuleGestionBundle\Entity\Multimedia $multimedia
     */
    public function removeMultimedia(\ModuleGestionBundle\Entity\Multimedia $multimedia)
    {
        $this->multimedias->removeElement($multimedia);
    }

    /**
     * Get multimedias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMultimedias()
    {
        return $this->multimedias;
    }

    /**
     * Set typeoeuvre
     *
     * @param \ModuleGestionBundle\Entity\TypeOeuvre $typeoeuvre
     *
     * @return Oeuvre
     */
    public function setTypeoeuvre(\ModuleGestionBundle\Entity\TypeOeuvre $typeoeuvre = null)
    {
        $this->typeoeuvre = $typeoeuvre;
    
        return $this;
    }

    /**
     * Get typeoeuvre
     *
     * @return \ModuleGestionBundle\Entity\TypeOeuvre
     */
    public function getTypeoeuvre()
    {
        return $this->typeoeuvre;
    }
}
