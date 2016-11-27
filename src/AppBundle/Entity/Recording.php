<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecordingRepository")
 * @ORM\Table(name="recording")
 * @Vich\Uploadable 
 */
class Recording
{
   public function __construct()
   {
        $this->registrationRequests = new ArrayCollection();
    }
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
    * @ORM\ManyToOne(targetEntity="TVShow", inversedBy="recordings")
    * @ORM\JoinColumn(nullable=false)
    */
    protected $tvShow;

       /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank()
    */
       protected $startTime;
   /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank()
    */
   protected $endTime;
   /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
    */
   protected $date;
   /**
     * @ORM\Column(type="string", nullable=true)
    */
   protected $information;

/**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"Bientôt Disponible", "Disponible", "Dernières places","Complet", "Annulé"})
    */
protected $availability;

 /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\RegistrationRequest", mappedBy="recording", cascade={"remove"})
   */
 protected $registrationRequests;


    /**
     * @ORM\Column(type="string", nullable=true)
    */
    protected $invitationName;

   /**
     * @Vich\UploadableField(mapping="invitation", fileNameProperty="invitationName")
    */
   protected $invitationFile; 

 public function getID() {
    return $this->id;
}

public function getStartTime() {
    return $this->startTime;
}

public function getEndTime() {
    return $this->endTime;
}

public function getTvShow() {
    return $this->tvShow;
}

public function getDate() {
    return $this->date;
}

public function getInformation() {
    return $this->information;
}

public function getAvailability() {
    return $this->availability;
}

public function setStartTime($startTime) {
    $this->startTime = $startTime;
}

public function setEndTime($endTime) {
    $this->endTime = $endTime;
}

public function setTvShow($tvShow) {
    $this->tvShow = $tvShow;
    $tvShow->addRecording($this);
}

public function setDate($date) {
    $this->date = $date;
}
public function setInformation($information) {
    $this->information = $information;
}
public function setAvailability($availability) {
    $this->availability = $availability;
}

public function addRegistrationRequest (RegistrationRequest $registrationRequest)
{
    $this->registrationRequests[] = $registrationRequest;
    return $this;
}

public function removeRegistrationRequest(RegistrationRequest $registrationRequest)
{
    $this->registrationRequests->removeElement($registrationRequest);
}

  public function getInvitationFile()
  {
    return $this->invitationFile;
  }

  public function setInvitationFile($invitationFile) {
    $this->invitationFile = $invitationFile;
  }

  public function getInvitationName() 
  {
    return $this->invitationName;
  }

  public function setInvitationName($invitationName) {
    $this->invitationName = $invitationName;
    $this->updatedAt = new \DateTime();
  }

public function __toString() 
{
    return (string) $this->getId();
}
}