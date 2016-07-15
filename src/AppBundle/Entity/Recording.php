<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="recording")
 */
class Recording
{

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
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(nullable=false)
    */
    protected $location;

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
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"En direct", "Enregistré"})
    */
   protected $recordingCondition;

/**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"Complet", "Disponible"})
    */
protected $availability;

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

public function getLocation() {
    return $this->location;
}

public function getDate() {
    return $this->date;
}

public function getRecordingCondition() {
    return $this->recordingCondition;
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
public function setLocation(Location $location) {
    $this->location = $location;
}
public function setDate($date) {
    $this->date = $date;
}
public function setRecordingCondition($recordingCondition) {
    $this->recordingCondition = $recordingCondition;
}
public function setAvailability($availability) {
    $this->availability = $availability;
}
public function __toString() 
{
    return (string) $this->getId();
}
}