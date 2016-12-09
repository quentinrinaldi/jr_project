<?php  // src/UserBundle/Form/Type/RegistrationFormType.php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType as EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lastName');
        $builder->add('firstName');
        $builder->remove('username');
        $builder->add('gender','choice', array(
            'choices'   => array('M' => 'Mr', 'F' => 'Mme'),
            'required'  => true,

            ));
        $builder->add('birthday',DateType::class, array(

            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            'html5' => false,
            'placeholder' => 'Date de naissance'
            ));

        $builder->add('phoneNumber','text', array(
            'required' => true));
        $builder->add('address','text');
        $builder->add('zipCode','text');
        $builder->add('city','text');
        $builder->add('country','text');
        $builder->add('newsletter','checkbox', array(
            'label' => 'J\'accepte recevoir des informations de la part de JRProduction',
            'required' => false,
            'label_attr' => array('class' => 'newsletter_label')));

        $builder->add('recaptcha', EWZRecaptchaType::class, array(
            'attr' => array(
                'options' => array(
                    'theme' => 'light',
                    'size'  => 'normal',
                    'type'  => 'image',
                    'defer' => true,
                    'async' => true
                )
            ),
            'mapped' => false,
            'constraints'   => array(
                new RecaptchaTrue()
            ),
            'error_bubbling' => true
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