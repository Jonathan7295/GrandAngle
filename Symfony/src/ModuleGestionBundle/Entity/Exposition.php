<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exposition
 *
 * @ORM\Table(name="exposition")
 * @ORM\Entity(repositoryClass="ModuleGestionBundle\Repository\ExpositionRepository")
 */
class Exposition
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
     * @ORM\Column(name="nomExposition", type="string", length=255)
     */
    private $nomExposition;

    /**
     * @var string
     *
     * @ORM\Column(name="evenement", type="string", length=255)
     */
    private $evenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateHeureDebutExposition", type="datetime")
     */
    private $dateHeureDebutExposition;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateHeureFinExposition", type="datetime")
     */
    private $dateHeureFinExposition;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreVisiteExposition", type="integer")
     */
    private $nombreVisiteExposition;

    /**
     * @ORM\OneToMany(targetEntity="TextExposition", mappedBy="exposition", cascade={"persist","remove"})
     */
    private $textexpositions;

    /**
     * @ORM\OneToMany(targetEntity="Emplacement", mappedBy="exposition", cascade={"persist","remove"})
     */
    private $emplacements;

    /**
     * @ORM\OneToOne(targetEntity="ModuleGestionBundle\Entity\Organisateur", cascade={"persist"})
     */
    private $organisateur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->textexpositions = new ArrayCollection();
        $this->emplacements = new ArrayCollection();
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
     * Set nomExposition
     *
     * @param string $nomExposition
     *
     * @return Exposition
     */
    public function setNomExposition($nomExposition)
    {
        $this->nomExposition = $nomExposition;
    
        return $this;
    }

    /**
     * Get nomExposition
     *
     * @return string
     */
    public function getNomExposition()
    {
        return $this->nomExposition;
    }

    /**
     * Set evenement
     *
     * @param string $evenement
     *
     * @return Exposition
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
    
        return $this;
    }

    /**
     * Get evenement
     *
     * @return string
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set dateHeureDebutExposition
     *
     * @param \DateTime $dateHeureDebutExposition
     *
     * @return Exposition
     */
    public function setDateHeureDebutExposition($dateHeureDebutExposition)
    {
        $this->dateHeureDebutExposition = $dateHeureDebutExposition;
    
        return $this;
    }

    /**
     * Get dateHeureDebutExposition
     *
     * @return \DateTime
     */
    public function getDateHeureDebutExposition()
    {
        return $this->dateHeureDebutExposition;
    }

    /**
     * Set dateHeureFinExposition
     *
     * @param \DateTime $dateHeureFinExposition
     *
     * @return Exposition
     */
    public function setDateHeureFinExposition($dateHeureFinExposition)
    {
        $this->dateHeureFinExposition = $dateHeureFinExposition;
    
        return $this;
    }

    /**
     * Get dateHeureFinExposition
     *
     * @return \DateTime
     */
    public function getDateHeureFinExposition()
    {
        return $this->dateHeureFinExposition;
    }

    /**
     * Set nombreVisiteExposition
     *
     * @param integer $nombreVisiteExposition
     *
     * @return Exposition
     */
    public function setNombreVisiteExposition($nombreVisiteExposition)
    {
        $this->nombreVisiteExposition = $nombreVisiteExposition;
    
        return $this;
    }

    /**
     * Get nombreVisiteExposition
     *
     * @return integer
     */
    public function getNombreVisiteExposition()
    {
        return $this->nombreVisiteExposition;
    }

    /**
     * Add textexposition
     *
     * @param \ModuleGestionBundle\Entity\TextExposition $textexposition
     *
     * @return Exposition
     */
    public function addTextexposition(\ModuleGestionBundle\Entity\TextExposition $textexposition)
    {
        $textexposition->setExposition($this);

        $this->textexpositions->add($textexposition);
    }

    /**
     * Remove textexposition
     *
     * @param \ModuleGestionBundle\Entity\TextExposition $textexposition
     */
    public function removeTextexposition(\ModuleGestionBundle\Entity\TextExposition $textexposition)
    {
        $this->textexpositions->removeElement($textexposition);
    }

    /**
     * Get textexpositions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTextexpositions()
    {
        return $this->textexpositions;
    }

    /**
     * Add emplacement
     *
     * @param \ModuleGestionBundle\Entity\Emplacement $emplacement
     *
     * @return Exposition
     */
    public function addEmplacement(\ModuleGestionBundle\Entity\Emplacement $emplacement)
    {
        $emplacement->setExposition($this);

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

    public function __toString()
    {
        return strval($this->id);
    }

    /**
     * Set emplacement
     *
     * @param \ModuleGestionBundle\Entity\Emplacement $emplacement
     *
     * @return Exposition
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

    /**
     * Set organisateur
     *
     * @param \ModuleGestionBundle\Entity\Organisateur $organisateur
     *
     * @return Exposition
     */
    public function setOrganisateur(\ModuleGestionBundle\Entity\Organisateur $organisateur = null)
    {
        $this->organisateur = $organisateur;
    
        return $this;
    }

    /**
     * Get organisateur
     *
     * @return \ModuleGestionBundle\Entity\Organisateur
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }
}
