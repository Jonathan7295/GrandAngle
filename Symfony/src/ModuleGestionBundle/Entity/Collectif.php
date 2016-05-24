<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Collectif
 *
 * @ORM\Table(name="collectif")
 * @ORM\Entity(repositoryClass="ModuleGestionBundle\Repository\CollectifRepository")
 */
class Collectif extends Organisateur
{
    /**
     * @var \DateTime
     */
    private $datecreation;

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Collectif
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;
    
        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }
}
