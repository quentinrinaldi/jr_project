<?php  // src/UserBundle/Form/Type/TVShowFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Entity\Location;
use AdminBundle\Form\Type\ChannelFormType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TVShowFormType extends AbstractType
{

    public function __construct($em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tvShow = $builder->getData();
 
        if ($tvShow != null) {
            $locationID = $builder->getData()->getLocation(); 
        }

        $builder->add('title','text', array(
            'trim' => true,
            'label'  => 'Nom de l\'emission'
            ));
        
        $builder->add('presenter','text', array(
            'trim' => true,
            'label'  => 'Présentateur',
            ));

        $builder->add('location','entity', array(
            'class' => 'AppBundle:Location',
            'choice_label'  => 'name',
            'choice_value' => 'id',
            'label'  => 'Lieu de tournage',
            'data' =>  $tvShow == null ? null : $builder->getData()->getLocation(), 
            'multiple' => false
            ));

        $builder->add('homePageVisibility', 'checkbox', array(
            'trim' => true,
            'label'  => 'Visible sur la page d\'accueil',
          
            'required' => false)
        );


        $builder->add('imageFile',FileType::class, array(
            'trim' => true,
            'label'  => 'Illustration',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));

        $builder->add('iconeFile',FileType::class, array(
            'trim' => true,
            'label'  => 'Logo de l\'émission',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));

        $builder->add('description', 'ckeditor', array(
            'config_name' => 'my_config',
            'label' => 'Description')
        );
        $builder->add('generalInformation', 'ckeditor', array(
            'config_name' => 'my_config',
            'label' => 'Informations pratiques')
        );

        $builder->add('underageLicenseFile',FileType::class, array(
            'trim' => true,
            'label'  => 'Autorisation de diffusion (personne mineure)',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));
        $builder->add('adultLicenseFile',FileType::class, array(
            'trim' => true,
            'label'  => 'Autorisation de diffusion (personne majeure)',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));

        $builder->add('licenseVisibility', 'checkbox', array(
            'trim' => true,
            'label'  => 'Intégrez les autorisation de diffusions dans les informations pratiques',
            'required' => false)
        );

    

    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AppBundle\Entity\TVShow');
    }


    public function getName()
    {
        return "tv_show";
    }
}