<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auteur
 *
 * @ORM\Table(name="auteur")
 * @ORM\Entity(repositoryClass="ModuleGestionBundle\Repository\AuteurRepository")
 */
class Auteur extends Organisateur
{
    /**
     * @var string
     */
    private $nationalite;

    /**
     * @var \DateTime
     */
    private $datenaissance;
    
    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Auteur
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
    
        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     *
     * @return Auteur
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;
    
        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }
}
