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
   ->getRepository('AppBundle:RegistrationRequest');
   $regRequests = $repository->findAll();

   return $this->render('AdminBundle:RegistrationRequest:index.html.twig', array('regRequests' => $regRequests));
 }
}