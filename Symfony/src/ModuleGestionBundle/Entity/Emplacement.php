<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Emplacement
 */
class Emplacement
{   
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Exposition")
     * @ORM\JoinColumn(nullable=FALSE)
     */
    private $exposition;

    /**
      * @ORM\ManyToOne(targetEntity="Oeuvre")
      * @ORM\JoinColumn(nullable=FALSE)
      */
    private $oeuvre;

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
     * Set position
     *
     * @param integer $position
     *
     * @return Emplacement
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }


    /**
     * Set exposition
     *
     * @param \ModuleGestionBundle\Entity\Exposition $exposition
     *
     * @return Emplacement
     */
    public function setExposition(\ModuleGestionBundle\Entity\Exposition $exposition)
    {
        $this->exposition = $exposition;
    
        return $this;
    }

    /**
     * Get exposition
     *
     * @return \ModuleGestionBundle\Entity\Exposition
     */
    public function getExposition()
    {
        return $this->exposition;
    }
}
