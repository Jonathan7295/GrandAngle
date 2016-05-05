<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ModuleGestionBundle\Entity\TexteExpo;
use ModuleGestionBundle\Entity\Exposition;
use ModuleGestionBundle\Entity\Langue;

/**
 * TraductionExpo
 */
class TraductionExpo
{
    /**
     * @ORM\OneToOne(targetEntity="ModuleGestionBundle/Entity/Langue", inversedBy="traductionexpos",cascade={"persist"})
     * @ORM\JoinColumn(name="idLangue", referencedColumnName="id")
     */
    private $langue;

    /**
     * @ORM\ManyToOne(targetEntity="ModuleGestionBundle/Entity/Exposition", inversedBy="traductionexpos",cascade={"persist"})
     * @ORM\JoinColumn(name="idExpo", referencedColumnName="id")
     */
     private $exposition;

    /**
     * @ORM\ManyToOne(targetEntity="ModuleGestionBundle/Entity/TexteExpo", inversedBy="traductionexpos",cascade={"persist"})
     * @ORM\JoinColumn(name="idTextexpo", referencedColumnName="id")
     */
    private $texteexpo;

    /**
     * @var integer
     */
    private $id;
    
    /**
     * Set langue
     *
     * @param \ModuleGestionBundle\Entity\Langue $langue
     *
     * @return TraductionExpo
     */
    public function setLangue(\ModuleGestionBundle\Entity\Langue $langue)
    {
        $this->langue = $langue;
    
        return $this;
    }

    /**
     * Get langue
     *
     * @return \ModuleGestionBundle\Entity\Langue
     */
    public function getLangue()
    {
        return $this->langue;
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
     * Set exposition
     *
     * @param \ModuleGestionBundle\Entity\Exposition $exposition
     *
     * @return TraductionExpo
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

       /**
     * Set texteexpo
     *
     * @param \ModuleGestionBundle\Entity\TexteExpo $texteexpo
     *
     * @return TraductionExpo
     */
    public function setTexteExpo(\ModuleGestionBundle\Entity\TexteExpo $texteexpo)
    {
        $this->texteexpo = $texteexpo;
    
        return $this;
    }

    /**
     * Get texteexpo
     *
     * @return \ModuleGestionBundle\Entity\TexteExpo
     */
    public function getTexteExpo()
    {
        return $this->texteexpo;
    }
}
