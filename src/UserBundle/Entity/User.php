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
      * @Assert\NotBlank(message="Name missing!")
    */
    protected $lastName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Name missing!")
    */
    protected $firstName;

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
}