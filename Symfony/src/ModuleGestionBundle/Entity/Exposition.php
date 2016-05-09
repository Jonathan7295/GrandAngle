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
     * @ORM\OneToMany(targetEntity="TraductionExpo", mappedBy="exposition",cascade={"remove", "persist"})
     */
    private $traductionexpos;

    /**
    * Get traductionexpo
    * @return  
    */
    public function getTraductionExpo()
    {
        return $this->traductionexpos;
    }
    
    /**
    * Set traductionexpo 
    * @return $this
    */
    public function setTraductionExpo($traductionexpos)
    {
        $this->traductionexpos = $traductionexpos;
        return $this;
    }

    public function __construct()
    {
        $this->traductionexpos = new ArrayCollection();
    }

    /**
     * Add traductionexpo
     *
     * @param ModuleGestionBundle\Entity\TraductionExpo $traductionexpo
     * @return Exposition
     */
    public function addTraductionExpo(\ModuleGestionBundle\Entity\TraductionExpo $traductionexpo)
    {
        $this->traductionexpos[] = $traductionexpo;
 
        return $this;
    }
 
    /**
     * Remove traductionexpo
     *
     * @param ModuleGestionBundle\Entity\TraductionExpo $traductionexpo
     */
    public function removeTraductionExpo(\ModuleGestionBundle\Entity\TraductionExpo $traductionexpo)
    {
        $this->traductionexpos->removeElement($traductionexpo);
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

    public function __toString()
    {
        return strval($this->id);
    }
}
