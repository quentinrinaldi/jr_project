<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ChannelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
        $builder->add('name','text', array(
            'trim' => true,
            'label'  => 'Nom de la chaine'
            ));
        
        $builder->add('imageFile',FileType::class, array(
            'trim' => true,
            'label'  => 'Illustration',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false

            ));

        $channel = $builder->getData();
        if ($channel != null) {
            $form = $builder->getForm();
            $form->get('imageFile')->setData($channel->getImageFile());
        }
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AppBundle\Entity\Channel');
    }


    public function getName()
    {
        return "Channel";
    }
}