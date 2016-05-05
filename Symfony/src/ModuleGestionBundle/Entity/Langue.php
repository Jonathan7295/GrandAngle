<?php

namespace ModuleGestionBundle\Entity;

/**
 * Langue
 */
class Langue
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nomLangue;


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
     * Set nomLangue
     *
     * @param string $nomLangue
     *
     * @return Langue
     */
    public function setNomLangue($nomLangue)
    {
        $this->nomLangue = $nomLangue;
    
        return $this;
    }

    /**
     * Get nomLangue
     *
     * @return string
     */
    public function getNomLangue()
    {
        return $this->nomLangue;
    }

    public function __toString()
    {
        return strval($this->id);
    }
}

