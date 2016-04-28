<?php

namespace ModuleGestionBundle\Entity;

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
}

