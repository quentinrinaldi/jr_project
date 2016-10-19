<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FAQFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
  
        $builder->add('question','text', array(
        'trim' => true,
        'label'  => 'Question'
        ));
        
        $builder->add('answer','text', array(
        'trim' => true,
        'label'  => 'Réponse',
        ));

    }

    public function getDefaultOptions(array $options)
{
    return array('data_class' => 'AppBundle\Entity\QuestionAnswer');
}


     public function getName()
    {
        return "QuestionAnswer";
    }
}