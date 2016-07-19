<?php 
namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadFormType extends AbstractType
{

    public function __construct() {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
 

        $builder->add('file',FileType::class, array(
            'trim' => true,
            'label'  => 'Fichier à importer',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));

        $builder->add('info','text', array(
            'trim' => true,
            'label'  => 'Commentaire optionnel',
            'required' => false
            ));
    }
}
        