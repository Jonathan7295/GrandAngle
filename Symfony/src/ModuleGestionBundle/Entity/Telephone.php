<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telephone
 */
class Telephone
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    public $numero;

    /**
     * @var string
     */
    public $libelle;
    
    /**
     * @ORM\ManyToOne(targetEntity="ModuleGestionBundle\Entity\Utilisateur", inversedBy="telephones",cascade={"persist"})
     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
     */
    
    private $utilisateur;

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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Telephone
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Telephone
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set utilisateur
     *
     * @param \ModuleGestionBundle\Entity\utilisateur $utilisateur
     *
     * @return Telephone
     */
    public function setUtilisateur(\ModuleGestionBundle\Entity\utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \ModuleGestionBundle\Entity\utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
