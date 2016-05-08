<?php

namespace ModuleGestionBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use ModuleGestionBundle\Entity\Langue;
use Doctrine\ORM\Mapping\OneToOne;
/**
 * TraductionExpo
 */
class TraductionExpo
{
    /**
     * @ORM\ManyToOne(targetEntity="ModuleGestionBundle\Entity\Exposition",inversedBy="traductionexpos", cascade={"remove"})
     * @ORM\JoinColumn(name="exposition_id", referencedColumnName="id")
     */
     private $exposition;

    /**
     * @var int
     */
    private $id;


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
     * @ORM\OneToOne(targetEntity="ModuleGestionBundle\Entity\Langue")
     * @ORM\JoinColumn(name="langue_id", referencedColumnName="id")
     */
    private $langue;


    /**
     * Set langue
     *
     * @param \ModuleGestionBundle\Entity\Langue $langue
     *
     * @return TraductionExpo
     */
    public function setLangue(\ModuleGestionBundle\Entity\Langue $langue = null)
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
}
