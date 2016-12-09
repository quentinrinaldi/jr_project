<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="emailTemplate")
 */
class EmailTemplate
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
    protected $acceptingNotificationText;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
    */
    protected $refusingNotificationText;
    
     
    public function getId() {
        return $this->id;
    }

    public function getAcceptingNotificationText() {
        return $this->acceptingNotificationText;
    }

    public function setAcceptingNotificationText($acceptingNotificationText) {
        $this->acceptingNotificationText = $acceptingNotificationText;
    }

    public function getRefusingNotificationText() {
        return $this->refusingNotificationText;
    }

    public function setRefusingNotificationText($refusingNotificationText) {
        $this->refusingNotificationText = $refusingNotificationText;
    }
}