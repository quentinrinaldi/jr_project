<?php  // src/UserBundle/Form/Type/TVShowFormType.php

namespace AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Entity\Channel;
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
            $channelID = $builder->getData()->getChannel(); 
        }

        $builder->add('title','text', array(
            'trim' => true,
            'label'  => 'Nom de l\'emission'
            ));
        
        $builder->add('presenter','text', array(
            'trim' => true,
            'label'  => 'Présentateur',
            ));

        $builder->add('channel','entity', array(
            'class' => 'AppBundle:Channel',
            'choice_label'  => 'name',
            'choice_value' => 'id',
            'label'  => 'Chaine',
            'data' =>  $tvShow == null ? null : $builder->getData()->getChannel(), 
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
            'label'  => 'Vignette',
            'attr' => array('class' => 'file', 'data-show-upload'=>'false'),
            'required' => false
            ));

        $builder->add('description', 'ckeditor', array(
            'config_name' => 'my_config',
            'label' => 'Description')
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