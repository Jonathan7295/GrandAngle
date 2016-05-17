<?php

namespace ModuleGestionBundle\Entity;

/**
 * TexteOeuvre
 */
class TexteOeuvre
{
    /**
     * @ORM\ManyToOne(targetEntity="Oeuvre", inversedBy="texteoeuvres")
     * @ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id")
     */
    private $oeuvre;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $description;


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
     * @return TexteOeuvre
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
     * Set oeuvre
     *
     * @param \ModuleGestionBundle\Entity\Oeuvre $oeuvre
     *
     * @return TexteOeuvre
     */
    public function setOeuvre(\ModuleGestionBundle\Entity\Oeuvre $oeuvre = null)
    {
        $this->oeuvre = $oeuvre;
    
        return $this;
    }

    /**
     * Get oeuvre
     *
     * @return \ModuleGestionBundle\Entity\Oeuvre
     */
    public function getOeuvre()
    {
        return $this->oeuvre;
    }
}
