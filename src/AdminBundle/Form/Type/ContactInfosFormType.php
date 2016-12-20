<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ContactInfosFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('address', 'ckeditor', array(
            'config_name' => 'my_config',
            'label' => 'Notre addresse')
        );

        $builder->add('phoneNumber', 'text', array(
            'label' => 'Numéro de téléphone')
        );

        $builder->add('openningTimes', 'text', array(
            'label' => 'Horaires')
        );

        $builder->add('email', 'text', array(
            'label' => 'Email')
        );

   
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AppBundle\Entity\ContactInfos');
    }
    
    public function getName()
    {
        return "ContactInfos";
    }
}