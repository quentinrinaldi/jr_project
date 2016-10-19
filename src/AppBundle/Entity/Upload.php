<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="upload")
 * @Vich\Uploadable 
 */
class Upload
{

	public function __construct()
	{
		$this->createdAt = new \DateTime();
    $this->info = "";
	}
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
  /**
     * @ORM\Column(type="string")
    */
  protected $fileName;
    /**
     * @Vich\UploadableField(mapping="file", fileNameProperty="fileName")
    */
    protected $file;

  /**
     * @ORM\Column(type="string")
    */
  protected $url;

  /**
     * @ORM\Column(type="text", nullable=true)
    */
  protected $info;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    public function getId() {
    	return $this->id;
    }
    public function getFilename() {
    	return $this->fileName;
    }

    public function getFile() {
    	return $this->file;
    }

    public function getUrl() {
    	return $this->url;
    }

    public function getInfo() {
    	return $this->info;
    }
    public function getCreatedAt() {
    	return $this->createdAt;
    }

    public function setFilename($fileName) {
    	$this->fileName=$fileName;
    }

    public function setFile($file) {
    	$this->file=$file;
    }
    public function setUrl($url) {
    	$this->url=$url;
    }
    public function setInfo($info) {
    	$this->info=$info;
    }

}