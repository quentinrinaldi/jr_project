<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lastName');
        $builder->add('firstName');
        $builder->remove('username');
        $builder->add('gender','choice', array(
        'choices'   => array('M' => 'Homme', 'F' => 'Femme'),
        'required'  => true,
        'label'  => 'Vous êtes',
        ));
        $builder->add('birthday','date', array(
            'widget' => 'single_text',
'input' => 'datetime',
'format' => 'dd/MM/yyyy',
        'label'  => 'Birthday',
        ));
        $builder->add('phoneNumber','number', array(
      
        'label'  => 'Numéro de téléphone',
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

     public function getName()
    {
        return $this->getBlockPrefix();
    }

    // For Symfony 2.x
    public function getFirstName()
    {
        return $this->getBlockPrefix();
    }

    public function getLastName()
    {
        return $this->getBlockPrefix();
    }
}
?>