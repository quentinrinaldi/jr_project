<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ContactInfos as ContactInfos;

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
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:ContactInfos');
        $questionAnswers = $repository->findAll();

        if ($questionAnswers == null) {
            $contactInfos = new ContactInfos();
        }
        else {
            $contactInfos = $questionAnswers[0];
        }

        return $this->render('AppBundle:Help:contact.html.twig',array('contactInfos' => $contactInfos));
    }

    public function showLegalNoticeAction() {
        return $this->render('AppBundle:Help:legal_notice.html.twig',array());
    }

    public function showAboutUsAction() {
        return $this->render('AppBundle:Help:about_us.html.twig');
    }
}