<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="slide")
 * @Vich\Uploadable 
 */
class Slide
{
  public function __construct()
  {
    $this->enabled = true; 
  }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

  /**
     * @ORM\Column(type="string")
    */
  protected $fileName;
    /**
     * @Vich\UploadableField(mapping="slide", fileNameProperty="fileName")
    */
    protected $file;

   /**
    * @ORM\ManyToOne(targetEntity="TVShow")
    * @ORM\JoinColumn(nullable=false)
    */
   protected $tvShow;
/**
* @ORM\Column(type="boolean", nullable=false)
    */
   protected $enabled;
   
   public function getId() {
     return $this->id;
   }
   public function getFilename() {
     return $this->fileName;
   }

   public function getFile() {
     return $this->file;
   }

   public function setFilename($fileName) {
     $this->fileName=$fileName;
   }

   public function setFile($file) {
     $this->file=$file;
   }

   public function getTvShow() {
    return $this->tvShow;
  }
  public function setTvShow($tvShow) {
    $this->tvShow = $tvShow;
  }

  public function getEnabled() {
    return $this->enabled;
  }

  public function setEnabled($boolean) {
    $this->enabled = $boolean;
  }

  public function switchVisibility() {
    $this->enabled = !$this->enabled;
  }

}