<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="contactInfos")
 */
class ContactInfos
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
    */
    protected $address;

   /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
   protected $phoneNumber;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $openningTimes;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
    */
    protected $email;

    public function getId() {
        return $this->id;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getOpenningTimes() {
        return $this->openningTimes;
    }

    public function setOpenningTimes($openningTimes) {
        $this->openningTimes = $openningTimes;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}