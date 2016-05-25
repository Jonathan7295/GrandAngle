<?php

namespace ModuleGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Multimedia
 *
 * @ORM\Table(name="multimedia")
 * @ORM\Entity(repositoryClass="ModuleGestionBundle\Repository\MultimediaRepository")
 */
class Multimedia
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
     * @var string $image
     *
     * @ORM\Column(name="image", type="string", length=255)
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg", "image/gif"}
     * )
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Oeuvre", inversedBy="multimedias", cascade={"persist"})
     * @ORM\JoinColumn(name="oeuvre_id", referencedColumnName="id")
     */
    private $oeuvre;

    

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
     * Set image
     *
     * @param string $image
     *
     * @return Multimedia
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getFullImagePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir().$this->image;
    }
  
    protected function getUploadRootDir()
    {
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }
  
    protected function getTmpUploadRootDir()
    {
        return __DIR__ . '/../../../../web/upload/';
    }

    /**
     * Sets the file name, needed to store the file when not using transloadit
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preUploadImage()
    {
        if ($this->image !== NULL) {
            $this->setImage('image.' .$this->image->guessExtension());
        }
    }
 
 
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadImage()
    {
        if (null === $this->image) {
            return;
        }
 
        $this->image->move($this->getUploadRootDir(), 'image.' .$this->image->guessExtension());
    }
      
    /**
     * @ORM\PostPersist()
     */
    public function moveImage()
    {
        if (null === $this->image) {
            return;
        }
        if(!is_dir($this->getUploadRootDir())){
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir().$this->image, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir().$this->image);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeImage()
    {
        unlink($this->getFullImagePath());
        rmdir($this->getUploadRootDir());
    }

    /**
     * Set oeuvre
     *
     * @param \ModuleGestionBundle\Entity\Oeuvre $oeuvre
     *
     * @return Multimedia
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
