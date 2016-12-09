<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EmailTemplateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('acceptingNotificationText', 'ckeditor', array(
            'config_name' => 'my_config',
            'label' => 'Inscription acceptée')
        );

          $builder->add('refusingNotificationText', 'ckeditor', array(
            'config_name' => 'my_config',
            'label' => 'Inscription refusée')
        );


   
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AppBundle\Entity\EmailTemplate');
    }
    
    public function getName()
    {
        return "EmailTemplate";
    }
}