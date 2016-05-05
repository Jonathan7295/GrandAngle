<?php

namespace ModuleGestionBundle\Entity;

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
