<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    public function welcomeAction()
    {
    	$repository = $this
		->getDoctrine()
		->getManager()
		->getRepository('AppBundle:Slide');

		$tvShowrepository = $this
		->getDoctrine()
		->getManager()
		->getRepository('AppBundle:TVShow');
		$tvShows= $tvShowrepository->findBy(array('homePageVisibility' => "1"));

		$slides = $repository->findByEnabled(true);
        return $this->render('index.html.twig',array('slides' => $slides, 'tvShows' => $tvShows));
    }
}