<?php


namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\SlideFormType;
use AppBundle\Entity\Slide;
use Symfony\Component\HttpFoundation\File\File;

class SliderConfigController extends Controller
{

	public function showConfigAction(Request $request)
	{
		$repository = $this
		->getDoctrine()
		->getManager()
		->getRepository('AppBundle:Slide');
		$slides = $repository->findAll();

		return $this->render('AdminBundle:SliderConfig:index.html.twig', array('slides' => $slides));
	}

	public function addSlideAction(Request $request) {
		$slide = new Slide();
		$form = $this->get('form.factory')->create(new SlideFormType(), $slide);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($slide);
			$em->flush();

			$request->getSession()->getFlashBag()->add('success', 'Le slide a bien été ajouté');
			return $this->redirect($this->generateUrl('slider_config'));
		}
		else {
			return $this->render('AdminBundle:SliderConfig:add.html.twig',array('form' => $form->createView(), 'slide' => $slide));
		}
	}
public function removeSlideAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$slide = $em->find('AppBundle:Slide', $id);
		$em->remove($slide);
		$em->flush();

		$request->getSession()->getFlashBag()->add('success', 'Le slide a bien été supprimé.');

		return $this->redirect($this->generateUrl('slider_config'));
	}

public function switchSlideVisibiltyAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$slide = $em->find('AppBundle:Slide', $id);
		$message = $slide->getEnabled() ? "Le slide a bien été masqué" : "Le slide est désormais visible sur la page d'accueil";
		$slide->switchVisibility();
		$em->flush();
		$request->getSession()->getFlashBag()->add('success', $message);
		
		return $this->redirect($this->generateUrl('slider_config'));
	}
}