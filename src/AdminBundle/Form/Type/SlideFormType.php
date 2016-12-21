<?php  // src/UserBundle/Form/Type/TVShowFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AppBundle\Entity\TVShow;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SlideFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options) {

    	$builder->add('tvShow','entity', array(
            'class' => 'AppBundle:TVShow',
            'choice_label'  => 'title',
            'choice_value' => 'id',
            'label'  => 'Emission',
            'multiple' => false,
            'placeholder' => 'Selectionnez une émission',
            ));

    	 $builder->add('file',FileType::class, array(
            'trim' => true,
            'label'  => 'Illustration',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => true
            ));
    	}
    }