<?php
// src/AppBundle/EventListener/UploadListener.php
namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
//use AppBundle\Entity\Channel;
use AppBundle\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class UploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader, $targetPath)
    {
        $this->uploader = $uploader;
        $this->targetPath = $targetPath;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
      //  if (!$entity instanceof Product) {
        //    return;
        //}

        $file = $entity->getUpload();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setUpload($fileName);
    }

   public function postLoad(LifecycleEventArgs $args)
    { 
    /*    $entity = $args->getEntity();
        $fileName = $entity->getUpload();
        $entity->setUpload(new File($this->targetPath.'/'.$fileName));
        */
    }

}