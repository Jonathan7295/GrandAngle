<?php

namespace ModuleGestionBundle\Entity;

/**
 * Langue
 */
class Langue
{
    /**
     * @var string
     */
    private $nomlangue;
    /**
     * @var integer
     */
    private $id;

    /**
    * Get id
    * @return  
    */
    public function getId()
    {
        return $this->id;
    }
    
    /**
    * Set id
    * @return $this
    */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
    * Get nomlangue
    * @return  
    */
    public function getNomLangue()
    {
        return $this->nomlangue;
    }
    
    /**
    * Set nomlangue
    * @return $this
    */
    public function setNomLangue($nomlangue)
    {
        $this->nomlangue = $nomlangue;
        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }
}
