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
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
    */
    protected $description;
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


public function getDescription() {
    return $this->description;
}

public function setName($name) {
    $this->name = $name;
}


public function setDescription($description) {
    $this->description = $description;
}

public function getImageName() 
{
  return $this->imageName;
}

public function setImageName($imageName) {
  $this->imageName = $imageName;
  $this->updatedAt = new \DateTime();
}

public function getImageFile()
{
  return $this->imageFile;
}

public function setImageFile($imageFile) {
  $this->imageFile = $imageFile;
}

public function update() {
  $this->updatedAt = new \DateTime();
}

public function __toString() 
{
    return (string) $this->getId();
}
}