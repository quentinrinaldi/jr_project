<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\RegistrationRequestFormType;
use AppBundle\Entity\RegistrationRequest;


class RegistrationRequestController extends Controller
{

	public function generateFormAction(Request $request, $recordingID)
	{
		$em = $this->getDoctrine()->getManager();
 		$recording = $em->find('AppBundle:Recording', $recordingID);
 		$user = $this->getUser();

		$entity = new RegistrationRequest();
		$entity->setUser($user);
		$entity->setRecording($recording);
		$entity->setStatus('En attente');


		$form = $this->createCreateForm($entity);

		


 		$form->handleRequest($request);
 		if ($form->isSubmitted() && $form->isValid()) {
 			
 			$em->persist($entity);
 			$em->flush();

      // On redirige vers la page de visualisation de l'annonce nouvellement créée
 			return $this->render('AppBundle:RegistrationRequest:confirmation.html.twig');
 		}
 		else {

		return $this->render('AppBundle:RegistrationRequest:new.html.twig',
			array(
				'entity' => $entity,
				'form' => $form->createView(),
				'recording' => $recording
				)
			);
	}
	}


public function validateRequestAction(Request $request)
{
    //This is optional. Do not do this check if you want to call the same action using a regular request.
	if (!$request->isXmlHttpRequest()) {
		return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
	}

	$entity = new RegistrationRequest();
	$form = $this->createCreateForm($entity);
	$form->handleRequest($request);

	if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
		$em->persist($entity);
		$em->flush();

		return new JsonResponse(array('message' => 'Success!'), 200);
	}

	$response = new JsonResponse(
		array(
			'message' => 'Error',
			'form' => $this->renderView('AppBundle:RegistrationRequest:new.html.twig',
				array(
					'entity' => $entity,
					'form' => $form->createView(),
					))), 400);

	return $response;
}

/**
 * Creates a form to create a Demo entity.
 *
 * @param Demo $entity The entity
 *
 * @return SymfonyComponentFormForm The form
 */
private function createCreateForm(RegistrationRequest $entity)
{
	$form = $this->createForm(new RegistrationRequestFormType(), $entity,
		array(
			//'action' => $this->generateUrl('demo_create'),
			'action' => "totp",
			'method' => 'POST',
			));

	return $form;
}
}