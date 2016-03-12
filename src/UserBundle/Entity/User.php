<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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


    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_USER');

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

    public function setBirthday($birthday) 
    {
        $this->birthday = $birthday; 
    }

    public function getBirthday() {
        return $this->birthday;
    }
}