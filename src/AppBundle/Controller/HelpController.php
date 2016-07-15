<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HelpController extends Controller
{
    public function showFAQAction()
    {
    	$repository = $this
		->getDoctrine()
		->getManager()
		->getRepository('AppBundle:QuestionAnswer');
		$questionAnswers = $repository->findAll();
        return $this->render('AppBundle:Help:faq.html.twig',array('questionAnswers' => $questionAnswers));
    }

    public function showContactAction()
    {
        return $this->render('AppBundle:Help:contact.html.twig',array());
    }
}