<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity
 * @ORM\Table(name="location")
 * @Vich\Uploadable 
 */
class Location
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $address;

       /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $helper;
 /**
     * @ORM\Column(type="string")
    */
    protected $imageName;

   /**
     * @Vich\UploadableField(mapping="studio", fileNameProperty="imageName")
    */
   protected $imageFile;
/**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
private $updatedAt;


    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getHelper() {
        return $this->helper;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setHelper($helper) {
        $this->helper = $helper;
    }

    public function getImageName() 
    {
      return $this->imageName;
    }

    public function setImageName($imageName) {
      $this->imageName = $imageName;
      $this->updatedAt = new \DateTime();
    }


    public function update() {
      $this->updatedAt = new \DateTime();
    }

    public function __toString() 
    {
        return (string) $this->getId();
    }
}