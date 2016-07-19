<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="tv_show")
 * @Vich\Uploadable 
 */
class TVShow
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
    protected $title;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $presenter;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
    */
    protected $description;

    /**
    * @ORM\ManyToOne(targetEntity="Channel")
     * @ORM\JoinColumn(nullable=false)
     */    
    protected $channel;

  /**
     * @ORM\Column(type="string")
    */
  protected $imageName;

   /**
     * @Vich\UploadableField(mapping="image", fileNameProperty="imageName")
    */
   protected $imageFile;

 /**
     * @ORM\Column(type="string")
    */
 protected $iconeName;

   /**
     * @Vich\UploadableField(mapping="icone", fileNameProperty="iconeName")
    */
   protected $iconeFile;

/**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
private $updatedAt;

    /**
   * @ORM\OneToMany(targetEntity="Recording", mappedBy="tvShow")
   */
    private $recordings;


    public function __construct()
    {
      $this->recordings = new ArrayCollection();
    }

    public function getId() {
      return $this->id;
    }

    public function getTitle() 
    {
      return $this->title;
    }

    public function getPresenter() 
    {
      return $this->presenter;
    }

    public function getDescription() {
      return $this->description;
    }

    public function getChannel() {
      return $this->channel;
    }

    public function setTitle($title) {
      $this->title = $title;
    }

    public function setPresenter($presenter) {
      $this->presenter = $presenter;
    }

    public function setDescription($description) {
      $this->description = $description;
    }
    
    public function setChannel($channel) {
      $this->channel = $channel;
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


    public function getImageFile()
    {
      return $this->imageFile;
    }

    public function setImageFile($imageFile) {
      $this->imageFile = $imageFile;
    }

    public function getIconeName() 
    {
      return $this->iconeName;
    }

    public function setIconeName($iconeName) {
      $this->iconeName = $iconeName;
      $this->updatedAt = new \DateTime();
    }


    public function getIconeFile()
    {
      return $this->iconeFile;
    }

    public function setIconeFile($iconeFile) {
      $this->iconeFile = $iconeFile;
    }

    public function addRecording (Recording $recording)
    {
      $this->recordings[] = $recording;
      
      return $this;
    }


    public function removeRecording(Recording $recording)
    {
      $this->recordings->removeElement($recording);
    }


    public function getRecordings()
    {
      return $this->recordings;
    }

    public function __toString() 
    {
      return (string) $this->getId();
    }


  }