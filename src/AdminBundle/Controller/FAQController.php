<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\FAQFormType;
use AppBundle\Entity\QuestionAnswer;


class FAQController extends Controller
{

  public function showFAQAction(Request $request)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:QuestionAnswer');
   $questionAnswers = $repository->findAll();

   return $this->render('AdminBundle:FAQ:index.html.twig', array('questionAnswers' => $questionAnswers));
  }

  public function addToFAQAction(Request $request) {
    $questionAnswer = new QuestionAnswer();
    $form = $this->get('form.factory')->create(new FAQFormType(), $questionAnswer);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($questionAnswer);
      $em->flush();

      $request->getSession()->getFlashBag()->add('sucess', 'Annonce bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
      return $this->redirect($this->generateUrl('admin_faq'));
    }
    else {
      return $this->render('AdminBundle:FAQ:add.html.twig',array('form' => $form->createView(), 'questionAnswer' => $questionAnswer));
    }
}
public function removeFromFAQAction(Request $request, $id) {
  $em = $this->getDoctrine()->getManager();
  $questionAnswer = $em->find('AppBundle:QuestionAnswer', $id);
  $em->remove($questionAnswer);
  $em->flush();

  $request->getSession()->getFlashBag()->add('success', 'Annonce bien enregistrée.');

  return $this->redirect($this->generateUrl('admin_faq'));
}

public function editAction(Request $request, $id) {
  $em = $this->getDoctrine()->getManager();
  $questionAnswer = $em->find('AppBundle:QuestionAnswer', $id);
  $form = $this->get('form.factory')->create(new FAQFormType(), $questionAnswer);

  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {
        //  $em->persist($questionAnswer);
    $em->flush();

    $request->getSession()->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
    return $this->redirect($this->generateUrl('admin_faq'));
  }
  else {
    return $this->render('AdminBundle:FAQ:edit.html.twig',array('form' => $form->createView(), 'questionAnswer' => $questionAnswer));
  }
}

}