<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exposition
 */
class Exposition
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nomExposition;

    /**
     * @var string
     */
    private $evenement;

    /**
     * @var \DateTime
     */
    private $dateHeureDebutExposition;

    /**
     * @var \DateTime
     */
    private $dateHeureFinExpositon;

    /**
     * @var int
     */
    private $nombreVisiteExposition;

    /**
     * @ORM\OneToMany(targetEntity="ModuleGestionBunlde/TextExposition", mappedBy="exposition", cascade={"remove"})
     */
    private $textexpositions;

    /**
     * @ORM\ManyToOne(targetEntity="Emplacement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $emplacement;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->textexpositions = new ArrayCollection();
    }

    /**
     * Add textexposition
     *
     * @param \ModuleGestionBundle\Entity\TextExpositions $textexposition
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
     * @param \ModuleGestionBundle\Entity\TextExpositions $textexposition
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
     * Set dateHeureFinExpositon
     *
     * @param \DateTime $dateHeureFinExpositon
     *
     * @return Exposition
     */
    public function setDateHeureFinExpositon($dateHeureFinExpositon)
    {
        $this->dateHeureFinExpositon = $dateHeureFinExpositon;
    
        return $this;
    }

    /**
     * Get dateHeureFinExpositon
     *
     * @return \DateTime
     */
    public function getDateHeureFinExpositon()
    {
        return $this->dateHeureFinExpositon;
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
    * Get evenement
    * @return  
    */
    public function getEvenement()
    {
        return $this->evenement;
    }
    
    /**
    * Set evenement
    * @return $this
    */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
        return $this;
    }

    /**
    * Set evenement
    * @return $this
    */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;
        return $this;
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
}
