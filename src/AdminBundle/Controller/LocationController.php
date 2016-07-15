<?php


namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\LocationFormType;
use AppBundle\Entity\Location;


class LocationController extends Controller
{

    public function showAllAction(Request $request)
    {
    	$repository = $this
 		 	->getDoctrine()
  			->getManager()
  			->getRepository('AppBundle:Location');
  		$locations = $repository->findAll();

        return $this->render('AdminBundle:Location:index.html.twig', array('locations' => $locations));
    }

    public function addAction(Request $request) {
    	$location = new Location();
    	$form = $this->get('form.factory')->create(new LocationFormType(), $location);

    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		  $em = $this->getDoctrine()->getManager();
      		$em->persist($location);
      		$em->flush();

      		$request->getSession()->getFlashBag()->add('success', 'Le lieu a bien été enregistré.');

      // On redirige vers la page de visualisation de l'annonce nouvellement créée
      return $this->redirect($this->generateUrl('admin_locations'));
    		}
    	else {
    		return $this->render('AdminBundle:Location:add.html.twig',array('form' => $form->createView(), 'location' => $location));
    	}
    }
     public function removeAction(Request $request, $id) {
     	$em = $this->getDoctrine()->getManager();
     	$location = $em->find('AppBundle:Location', $id);
    	$em->remove($location);
		  $em->flush();

      $request->getSession()->getFlashBag()->add('success', 'Annonce bien enregistrée.');

      	return $this->redirect($this->generateUrl('admin_locations'));
    		}

      public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $location = $em->find('AppBundle:Location', $id);
        $form = $this->get('form.factory')->create(new LocationFormType(), $location);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          
          $em->flush();

          $request->getSession()->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
          return $this->redirect($this->generateUrl('admin_locations'));
        }
        else {
          return $this->render('AdminBundle:Location:edit.html.twig',array('form' => $form->createView(), 'location' => $location));
        }
        }

    
}