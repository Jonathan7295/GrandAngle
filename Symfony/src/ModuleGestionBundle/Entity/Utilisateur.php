<?php
// src/ModuleGestionBundle/Entity/Utilisateur.php

namespace ModuleGestionBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 */
class Utilisateur extends BaseUser
{
    /**
     * @ORM\OneToMany(targetEntity="ModuleGestionBundle\Entity\Telephone", mappedBy="utilisateur")
     */
    protected $telephones;

    /**
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    
    public function __construct()
    {
        parent::__construct();
        $this->enabled = true;
        $this->role = "USER";
        $this->telephones = new ArrayCollection();
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Utilisateur
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Utilisateur
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }


    /**
     * Add telephone
     *
     * @param \ModuleGestionBundle\Entity\Telephone $telephone
     *
     * @return Utilisateur
     */
    public function addTelephone(\ModuleGestionBundle\Entity\Telephone $telephone)
    {
        $this->telephones[] = $telephone;
    
        return $this;
    }

    /**
     * Remove telephone
     *
     * @param \ModuleGestionBundle\Entity\Telephone $telephone
     */
    public function removeTelephone(\ModuleGestionBundle\Entity\Telephone $telephone)
    {
        $this->telephones->removeElement($telephone);
    }

    /**
     * Get telephones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTelephones()
    {
        return $this->telephones;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Utilisateur
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
}
