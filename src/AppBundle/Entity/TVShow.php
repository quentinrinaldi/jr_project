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
     * @ORM\Column(type="boolean")
    */
    protected $homePageVisibility;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
    */
    protected $description;
 /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
    */
    protected $generalInformation;
    /**
    * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(nullable=false)
     */    
    protected $location;

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
     * @ORM\Column(type="string")
    */
  protected $underageLicenseName;

   /**
     * @Vich\UploadableField(mapping="underageLicense", fileNameProperty="underageLicenseName")
    */
   protected $underageLicenseFile;

    /**
     * @ORM\Column(type="string")
    */
  protected $adultLicenseName;

   /**
     * @Vich\UploadableField(mapping="adultLicense", fileNameProperty="adultLicenseName")
    */
   protected $adultLicenseFile;

/**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
private $updatedAt;

    /**
   * @ORM\OneToMany(targetEntity="Recording", mappedBy="tvShow", cascade={"remove"})
   */
    private $recordings;


    public function __construct()
    {
      $this->recordings = new ArrayCollection();
      $this->homePageVisibiliy = false;
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

    public function getLocation() {
      return $this->location;
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
    
    public function setLocation($location) {
      $this->location = $location;
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

    public function getHomePageVisibility() {
      return $this->homePageVisibility;
    }

    public function setHomePageVisibility($homePageVisibility) {
      $this->homePageVisibility=$homePageVisibility;
    }

    public function getGeneralInformation() {
      return $this->generalInformation;
    }

    public function setGeneralInformation($infos) {
       $this->generalInformation = $infos;
    }
    
    public function __toString() 
    {
      return (string) $this->getId();
    }

    public function getAdultLicenseFile()
    {
      return $this->adultLicenseFile;
    }

    public function setAdultLicenseFile($adultLicenseFile) {
      $this->adultLicenseFile = $adultLicenseFile;
    }

    public function getAdultLicenseName()
    {
      return $this->adultLicenseName;
    }

    public function setAdultLicenseName($adultLicenseName) {
      $this->adultLicenseName = $adultLicenseName;
      $this->updatedAt = new \DateTime();
    }

    public function getUnderageLicenseFile()
    {
      return $this->underageLicenseFile;
    }

    public function setUnderageLicenseFile($underageLicenseFile) {
      $this->underageLicenseFile = $underageLicenseFile;
    }

    public function getUnderageLicenseName() 
    {
      return $this->underageLicenseName;
    }

    public function setUnderageLicenseName($underageLicenseName) {
      $this->underageLicenseName = $underageLicenseName;
      $this->updatedAt = new \DateTime();
    }

  }