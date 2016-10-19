<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CalendarController extends Controller
{
    public function showAction()
    {
    	$repository = $this
		->getDoctrine()
		->getManager()
		->getRepository('AppBundle:Recording');
		$recordings = $repository->findAll();
        return $this->render('AppBundle:Calendar:index.html.twig',array('recordings' => $recordings));
    }
}