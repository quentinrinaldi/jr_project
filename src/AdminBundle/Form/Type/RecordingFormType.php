<?php  // src/UserBundle/Form/Type/TVShowFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Entity\Channel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RecordingFormType extends AbstractType
{

    public function __construct($em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $recording = $builder->getData();
        if ($recording != null) {
            $tvShowID = $builder->getData()->getTvShow(); 
        }
        $builder->add('tvShow','entity', array(
            'class' => 'AppBundle:TVShow',
            'choice_label'  => 'title',
            'choice_value' => 'id',
            'label'  => 'Emission',
            'multiple' => false,
            'placeholder' => 'Selectionnez une émission',
            ));
        

        $builder->add('date','date', array(
            'trim' => true,
            'label'  => 'Date',
            ));
        $builder->add('startTime','time', array(
            'trim' => true,
            'label'  => 'Heure de début',
            ));

        $builder->add('endTime','time', array(
            'trim' => true,
            'label'  => 'Heure de fin',
            ));


        $builder->add('information','text', array(
            'trim' => true,
            'label'  => 'Information concernant le tournage',
             'required'  => false,
            ));

        $builder->add('availability','choice', array(
        'choices'   => array("Bientôt Disponible" => "Bientôt Disponible", "Disponible" => "Disponible", "Dernières places" => "Dernières places", "Complet" => "Complet", "Annulé" => "Annulé"),
        'required'  => true,
        'label'  => 'Statut de l\'émission',
        'empty_data' => 'Bientôt Disponible'
        ));

        $builder->add('invitationFile',FileType::class, array(
            'trim' => true,
            'label'  => 'Invitation',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));
        
        }

        public function getDefaultOptions(array $options)
        {
            return array('data_class' => 'AppBundle\Entity\Recording');
        }


        public function getName()
        {
            return "recording";
        }
    }