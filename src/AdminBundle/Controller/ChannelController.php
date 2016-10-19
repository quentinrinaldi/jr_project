<?php


namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\ChannelFormType;
use AppBundle\Entity\Channel;
use Symfony\Component\HttpFoundation\File\File;

class ChannelController extends Controller
{

    public function showAllAction(Request $request)
    {
    	$repository = $this
 		 	->getDoctrine()
  			->getManager()
  			->getRepository('AppBundle:Channel');
  		$channels = $repository->findAll();

        return $this->render('AdminBundle:Channel:index.html.twig', array('channels' => $channels));
    }

    public function addAction(Request $request) {
    	$channel = new Channel();
    	$form = $this->get('form.factory')->create(new ChannelFormType(), $channel);

    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		  $em = $this->getDoctrine()->getManager();
      		$em->persist($channel);
      		$em->flush();

      		$request->getSession()->getFlashBag()->add('sucess', 'Annonce bien enregistrée.');

      // On redirige vers la page de visualisation de l'annonce nouvellement créée
      return $this->redirect($this->generateUrl('admin_channels'));
    			// return $this->render("AdminBundle:Channel:showAll");
    		}
    	else {
    		return $this->render('AdminBundle:Channel:add.html.twig',array('form' => $form->createView(), 'channel' => $channel));
    	}
    }
     public function removeAction(Request $request, $id) {
     	$em = $this->getDoctrine()->getManager();
     	$channel = $em->find('AppBundle:Channel', $id);
    	$em->remove($channel);
		  $em->flush();

      $request->getSession()->getFlashBag()->add('success', 'Annonce bien enregistrée.');

      	return $this->redirect($this->generateUrl('admin_channels'));
    			// return $this->render("AdminBundle:Channel:showAll");
    		}

      public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $channel = $em->find('AppBundle:Channel', $id);

      //  $fileName = $channel->getUpload();
       // $channel->setUpload(new File($this->getParameter("uploads_directory").'/'.$fileName));

        $form = $this->get('form.factory')->create(new ChannelFormType(), $channel);
    //    $em->refresh($channel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
         
          $em->flush();

          $request->getSession()->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
          return $this->redirect($this->generateUrl('admin_channels'));
        }
        else {
          return $this->render('AdminBundle:Channel:edit.html.twig',array('form' => $form->createView(), 'channel' => $channel));
          // return $this->render("AdminBundle:Channel:showAll");
        }
        }

    
}