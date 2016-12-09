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
   $regRequests = $repository->getRegistrationRequestsOfTvShow($tvshowID);

   $tvShowRepository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:TVShow');

   $tvShow = $tvShowRepository->find($tvshowID);
   return $this->render('AdminBundle:RegistrationRequest:show_requests.html.twig', array('regRequests' => $regRequests, 'tvShow' => $tvShow));
 }

 public function acceptAction(Request $request, $registrationRequestID) {

  /* Database access and variables initialisation*/
  $repository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('AppBundle:RegistrationRequest');

  $em         = $this->getDoctrine()->getManager();
  $regRequest = $repository->getRegistrationRequestWithRecordingAndLocation($registrationRequestID);
  $user       = $regRequest->getUser();
  $recording  = $regRequest->getRecording();
  $tvShow     = $recording->getTvShow();

  $emailTemplateRepository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('AppBundle:EmailTemplate');
  
  $emailTemplate = $emailTemplateRepository->find(1);
  

  /* Initialisation of attachments path" */  
  $uploadPath              = $this->get('kernel')->getRootDir()."/../web/uploads/";
  $mapFilePath             = $uploadPath.$tvShow->getLocation()->getMapName();
  $underageLicenseFilePath = $uploadPath.$tvShow->getUnderageLicenseName();
  $adultLicenseFilePath    = $uploadPath.$tvShow->getAdultLicenseName();
  $invitationPath          = $uploadPath.$recording->getInvitationName();

  /* Email properties */
  $mailSubject = "Votre demande pour assister à l'émission".$tvShow->getTitle();

  /* Body customisation */ 
  $body        = $emailTemplate->getAcceptingNotificationText();
  $matcher     = array('[[PRENOM]]' => $user->getFirstName(), '[[EMISSION]]' => $tvShow->getTitle(), '[[DATE]]' => $recording->getDate()->format('l d F Y')." de ".$recording->getStartTime()->format("H\hi")." à ".$recording->getEndTime()->format("H\hi"));
  $emailParser = $this->container->get('admin.email_parser');
  $customBody  = $emailParser->parseText($body, $matcher);

  $message = \Swift_Message::newInstance()
  ->setSubject($mailSubject)
  ->setFrom('quentind2@gmail.com')
  ->setTo('quentin.rinaldi@gmail.com')
  ->setBody( 
    $customBody,
    'text/html')
  ->attach(\Swift_Attachment::fromPath($invitationPath)->setFileName("invitation.pdf"))
  ->attach(\Swift_Attachment::fromPath($underageLicenseFilePath)->setFileName("Autorisation_de_diffusion_mineur.pdf"))
  ->attach(\Swift_Attachment::fromPath($adultLicenseFilePath)->setFileName("Autorisation_de_diffusion_majeur.pdf"))
  ->attach(\Swift_Attachment::fromPath($mapFilePath)->setFileName("Plan.pdf"));

  try {
    $test = $this->get('mailer')->send($message);
  }
  catch (\Swift_IoException $e) {
    $array = array( 'success' => $e->getMessage() ); // data to return via JSON
    $response = new Response( json_encode( $array ) );
    $response->headers->set( 'Content-Type', 'application/json' );

    return $response;
  }

  $regRequest->setState('Acceptée');
  $em->persist($regRequest);
  $em->flush();

  $array = array( 'success' => $test ); // data to return via JSON
  $response = new Response( json_encode( $array ) );
  $response->headers->set( 'Content-Type', 'application/json' );

  return $response;

}
}