<?php

namespace ModuleGestionBundle\Entity;
use ModuleGestionBundle\Entity\Organisateur;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\ORM\Mapping as ORM;

/**
<<<<<<< HEAD
 * Collectif
 *
 * @ORM\Table(name="collectif")
 * @ORM\Entity(repositoryClass="ModuleGestionBundle\Repository\CollectifRepository")
=======
 * @ORM\MappedSuperclass
 * @ORM\Entity
 * @ORM\Table(name="Collectif")
>>>>>>> 44b8f8d12b53fe51b96df24186d5b67405e9e521
 */
class Collectif extends Organisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="datecreation", type="datetime")
     */
    private $datecreation;

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
