<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LocationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','text', array(
        'trim' => true,
        'label'  => 'Nom du lieu de tournage'
        ));
        
          $builder->add('imageFile',FileType::class, array(
            'trim' => true,
            'label'  => 'Illustration',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));

        $builder->add('description', 'ckeditor', array(
            'config_name' => 'my_config',
            'label' => 'Description')
        );

        $builder->add('mapFile',FileType::class, array(
            'trim' => true,
            'label'  => 'Plan',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AppBundle\Entity\Location');
    }
    
    public function getName()
    {
        return "Location";
    }
}