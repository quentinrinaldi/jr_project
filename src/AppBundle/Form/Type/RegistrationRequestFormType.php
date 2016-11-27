<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class RegistrationRequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
        $builder->add('peopleNumber','choice', array(
        'choices'   => array('1' => 1, '2' => 2,'3' => 3,'4' => 4,'5' => 5),
        'required'  => true,
        'label'  => 'Nombre de places demandées',
        ));

    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AppBundle\Entity\RegistrationRequest');
    }


    public function getName()
    {
        return "RegistrationRequest";
    }
}