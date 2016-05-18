<?php

namespace ModuleGestionBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("orgnisateur")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"organisateur" = "Organisateur", "auteur" = "Auteur", "collectif" = "Collectif"})
 */
class Organisateur
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="ModuleGestionBunlde/Exposition", mappedBy="organisateur", cascade={"remove"})
     */
    private $expositions;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Organisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->expositions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add exposition
     *
     * @param \ModuleGestionBundle\Entity\Exposition $exposition
     *
     * @return Organisateur
     */
    public function addExposition(\ModuleGestionBundle\Entity\Exposition $exposition)
    {
        $this->expositions[] = $exposition;
    
        return $this;
    }

    /**
     * Remove exposition
     *
     * @param \ModuleGestionBundle\Entity\Exposition $exposition
     */
    public function removeExposition(\ModuleGestionBundle\Entity\Exposition $exposition)
    {
        $this->expositions->removeElement($exposition);
    }

    /**
     * Get expositions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpositions()
    {
        return $this->expositions;
    }
}
