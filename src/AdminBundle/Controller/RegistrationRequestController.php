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

  public function selectTvShowAction(Request $request)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:TVShow');
   $tvShows = $repository->findAll();
   return $this->render('AdminBundle:RegistrationRequest:index.html.twig', array('tvShows' => $tvShows));
 }

  public function showAction(Request $request, $tvshowID)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:RegistrationRequest');
   $regRequests = $repository->getRegistrationRequests($tvshowID);

   $tvShowRepository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:TVShow');

   $tvShow = $tvShowRepository->find($tvshowID);
   return $this->render('AdminBundle:RegistrationRequest:show_requests.html.twig', array('regRequests' => $regRequests, 'tvShow' => $tvShow));
 }

 public function acceptAction(Request $request, $registrationRequestID) {
  $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:RegistrationRequest');
   $regRequests = $repository->find($registrationRequestID);

  $user = $regRequests->getUser();

  $array = array( 'success' => true ); // data to return via JSON
  $response = new Response( json_encode( $array ) );
  $response->headers->set( 'Content-Type', 'application/json' );
 
  return $response;

 }

}