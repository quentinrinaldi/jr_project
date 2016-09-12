<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
            'placeholder' => 'Sexe'

            ));
        $builder->add('birthday',DateType::class, array(

            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',

    // do not render as type="date", to avoid HTML5 date pickers
            'html5' => false,

    // add a class that can be selected in JavaScript
            'placeholder' => 'Date de naissance'
            ));
        $builder->add('phoneNumber','number');

        $builder->add('address','text');
        $builder->add('zipCode','text');
        $builder->add('city','text');
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