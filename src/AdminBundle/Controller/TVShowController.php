<?php 

namespace AdminBundle\Controller;

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

 		return $this->render('AdminBundle:TVShow:index.html.twig', array('tvShows' => $tvShows));
 	}

 	public function addAction(Request $request) {
 		$tvShow = new TVShow();
 		$em = $this->getDoctrine()->getManager();
 		$form = $this->get('form.factory')->create(new TVShowFormType($em), $tvShow);

 		$form->handleRequest($request);
 		if ($form->isSubmitted() && $form->isValid()) {
 			
 			$em->persist($tvShow);
 			$em->flush();

 			$request->getSession()->getFlashBag()->add('success', "L'émission a bien été enregistrée.");

      // On redirige vers la page de visualisation de l'annonce nouvellement créée
 			return $this->redirect($this->generateUrl('admin_tvshows'));
 		}
 		else {
 			return $this->render('AdminBundle:TVShow:add.html.twig',array('form' => $form->createView(), 'tvShow' => $tvShow));
 		}
 	}
 	public function removeAction(Request $request, $id) {
 		$em = $this->getDoctrine()->getManager();
 		$tvShow = $em->find('AppBundle:TVShow', $id);
 		$em->remove($tvShow);
 		$em->flush();

 		$request->getSession()->getFlashBag()->add('success', "L'émission a bien été supprimée.");

 		return $this->redirect($this->generateUrl('admin_tvshows'));
 	}

 	public function editAction(Request $request, $id) {
 		$em = $this->getDoctrine()->getManager();
 		$tvShow = $em->find('AppBundle:TVShow', $id);
 		$form = $this->get('form.factory')->create(new TVShowFormType($em), $tvShow);

 		$form->handleRequest($request);
 		if ($form->isSubmitted() && $form->isValid()) {
 			$tvShow->update();
 			$em->flush();

 			$request->getSession()->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
 			return $this->redirect($this->generateUrl('admin_tvshows'));
 		}
 		else {
 			return $this->render('AdminBundle:TVShow:edit.html.twig',array('form' => $form->createView(), 'tvShow' => $tvShow));
 		}
 	}
 }