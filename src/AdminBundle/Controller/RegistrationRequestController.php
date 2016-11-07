<?php


namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\RecordingFormType;
use AppBundle\Entity\Recording;
use Symfony\Component\HttpFoundation\File\File;

class RegistrationRequestController extends Controller
{

  public function showAllAction(Request $request)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:TVShow');
   $tvshows = $repository->findAll();

   return $this->render('AdminBundle:RegistrationRequest:index.html.twig', array('tvShows' => $tvShows));
 }

  public function showAction(Request $request, $id)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:RegistrationRequest');
   $recordings = $repository->getRegistrationRequests($id);

   return $this->render('AdminBundle:Recording:registration_requests.html.twig', array('registrationRequests' => $registrationRequests));
 }
}