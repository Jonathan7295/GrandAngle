<?php

namespace ModuleGestionBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TexteExpo
 */
class TexteExpo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $descriptionTextexpo;

    /**
     * @ORM\OneToMany(targetEntity="ModuleGestionBundle/Entity/TraductionExpo", mappedBy="texteexpo")
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
     * Add traductionexpos
     *
     * @param ModuleGestionBundle\Entity\TraductionExpo $traductionexpos
     * @return TexteExpo
     */
    public function addTraductionExpo(ModuleGestionBundle\Entity\TraductionExpo $traductionexpos)
    {
        $this->traductionexpos[] = $traductionexpos;
 
        return $this;
    }
 
    /**
     * Remove traductionexpos
     *
     * @param ModuleGestionBundle\Entity\TraductionExpo $traductionexpos
     */
    public function removeTraductionExpo(ModuleGestionBundle\Entity\TraductionExpo $traductionexpos)
    {
        $this->traductionexpos->removeElement($traductionexpos);
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
     * Set descriptionTextexpo
     *
     * @param string $descriptionTextexpo
     *
     * @return TexteExpo
     */
    public function setDescriptionTextexpo($descriptionTextexpo)
    {
        $this->descriptionTextexpo = $descriptionTextexpo;
        return $this;
    }

    /**
     * Get descriptionTextexpo
     *
     * @return string
     */
    public function getDescriptionTextexpo()
    {
        return $this->descriptionTextexpo;
    }
}
