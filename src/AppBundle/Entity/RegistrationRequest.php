<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use UserBundle\Entity\User as User;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrationRequestRepository")
 * @ORM\Table(name="registration_request")
 * @ORM\HasLifecycleCallbacks
 */
class RegistrationRequest
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
    * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="registrationRequests")
     * @ORM\JoinColumn(nullable=false)
     */   
    protected $user;	

	/**
    * @ORM\ManyToOne(targetEntity="Recording")
     * @ORM\JoinColumn(nullable=false)
     */    
	protected $recording;

	/**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"En attente", "Validée", "Refusée"})
    */
	protected $state;

	/**
     * @ORM\Column(type="datetime")
     */
	protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    	/**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */  
        protected $peopleNumber;
/**
 * @ORM\PrePersist
 * @ORM\PreUpdate
 */
public function updatedTimestamps()
{
	$this->setUpdatedAt(new \DateTime('now'));

	if ($this->getCreatedAt() == null) {
		$this->setCreatedAt(new \DateTime('now'));
	}
}

public function getID() {
	return $this->id;
}

public function getUser() {
	return $this->user;
}

public function setUser(User $user) {
	$this->user = $user;
    $this->user->addRegistrationRequest($this);
}

public function getRecording() {
	return $this->recording;
}

public function setRecording($recording) {
	$this->recording = $recording;
   $this->recording->addRegistrationRequest($this);
}

public function getState() {
	return $this->state;
}

public function setState($state) {
	$this->state = $state;
}

public function getCreatedAt() {
	return $this->createdAt;
}

public function setCreatedAt($createdAt) {
	$this->createdAt = $createdAt;
}

public function getUpdatedAt() {
	return $this->updatedAt;
}

public function setUpdatedAt($updatedAt) {
	$this->updatedAt = $updatedAt;
}

public function getPeopleNumber() {
    return $this->peopleNumber;
}

public function setPeopleNumber($peopleNumber) {
    $this->peopleNumber = $peopleNumber;
}


}