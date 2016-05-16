<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TextExposition
 */
class TextExposition
{
    /**
    * @ORM\ManyToOne(targetEntity="Exposition", inversedBy="textexpositions")
    * @ORM\JoinColumn(name="exposition_id", referencedColumnName="id")
    */
    private $exposition;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $langue;


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
     * Set description
     *
     * @param string $description
     *
     * @return TextExposition
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set langue
     *
     * @param string $langue
     *
     * @return TextExposition
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;
    
        return $this;
    }

    /**
     * Get langue
     *
     * @return string
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set exposition
     *
     * @param \ModuleGestionBundle\Entity\Exposition $exposition
     *
     * @return TextExposition
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
