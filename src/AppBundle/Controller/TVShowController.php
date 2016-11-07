<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\TVShowFormType;
use AppBundle\Entity\TVShow;
class TVShowController extends Controller
{

	public function showAllAction(Request $request)
	{
		$repository = $this
		->getDoctrine()
		->getManager()
		->getRepository('AppBundle:TVShow');
		$tvShows = $repository->findAll();

		return $this->render('AppBundle:TVShow:home.html.twig', array('tvShows' => $tvShows));
	}

	public function showAction(Request $request, $id)
	{
		$tvShowRepository = $this
		->getDoctrine()
		->getManager()
		->getRepository('AppBundle:TVShow');

		$recorgingRepository = $this->getDoctrine()
		->getManager()
		->getRepository('AppBundle:Recording');

 		$tvShow = $tvShowRepository->find($id);
 		$recordings = $recorgingRepository->getNextRecordings($tvShow->getId());
		return $this->render('AppBundle:TVShow:tvshow_details.html.twig', array('tvShow' => $tvShow, 'next_recordings' => $recordings));
	}
}