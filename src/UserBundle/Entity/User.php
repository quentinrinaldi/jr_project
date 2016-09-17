<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\RegistrationRequest as RegistrationRequest;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
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
    protected $lastName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $firstName;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */    
    protected $birthday;

    /**
     * @ORM\Column(type="string",length=1)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"M", "F"})
     */

    protected $gender;

    /**
     * @ORM\Column(type="integer",length=10)
     * @Assert\NotBlank()
     */
    protected $phoneNumber;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $address;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $zipCode;

        /**
     * @ORM\Column(type="string")
      * @Assert\NotBlank()
    */
    protected $city;

  /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\RegistrationRequest", mappedBy="user")
   */
  protected $registrationRequests;

  public function __construct()
  {
    parent::__construct();
    $this->roles = array('ROLE_USER');
    $this->registrationRequests = new ArrayCollection();

}

public function getLastName() 
{
    return $this->lastName;
}

public function getFirstName() 
{
    return $this->firstName;
}

public function setLastName($lastName) {
    $this->lastName = $lastName;
}

public function setFirstName($firstName) {
    $this->firstName = $firstName;
}

public function setEmail($email)
{
    $email = is_null($email) ? '' : $email;
    parent::setEmail($email);
    $this->setUsername($email);

    return $this;
}

public function setGender($gender) 
{
    $this->gender = $gender; 
}

public function getGender() {
    return $this->gender;
}


public function getBirthday() {
    return $this->birthday;
}

public function setBirthday($birthday) 
{
    $this->birthday = $birthday; 
}

public function getPhoneNumber() {
    return $this->birthday;
}

public function setPhoneNumber($phoneNumber) {
    return $this->phoneNumber = $phoneNumber;
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


public function getRegistrationRequests()
{
    return $this->registrationRequests;
}

public function getAddress() {
    return $this->address;
}

public function setAddress($address) 
{
    $this->address = $address; 
}

public function getZipCode() {
    return $this->zipCode;
}

public function setZipCode($zipCode) 
{
    $this->zipCode = $zipCode; 
}

public function getCity() {
    return $this->city;
}

public function setCity($city) 
{
    $this->city = $city; 
}
}