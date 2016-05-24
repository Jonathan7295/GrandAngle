<?php

namespace ModuleGestionBundle\Entity;
use ModuleGestionBundle\Entity\Organisateur;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\Entity
 * @ORM\Table(name="Collectif")
 */
class Collectif extends Organisateur
{
    /**
     * @var \DateTime
     * @ORM\Column(name="datecreation", type="datetime")
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

