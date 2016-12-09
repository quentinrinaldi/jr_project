<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\EmailTemplateFormType;
use AppBundle\Entity\EmailTemplate;


class EmailTemplateController extends Controller
{

  public function showEmailTemplateAction(Request $request)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:EmailTemplate');
   $emailTemplates = $repository->findAll();

   if ($emailTemplates == null) {
      return $this->addEmailTemplateAction($request);
   }
   else {
    return $this->editEmailTemplateAction($request, $emailTemplates[0]->getId());
   }  
  }

  public function addEmailTemplateAction(Request $request) {
    $emailTemplate = new EmailTemplate();
    $form = $this->get('form.factory')->create(new EmailTemplateFormType(), $emailTemplate);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($emailTemplate);
      $em->flush();

      $request->getSession()->getFlashBag()->add('success', "L'occurence des templates email à bien été créée");

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
      return $this->redirect($this->generateUrl('show_email_template'));
    }
    else {
      return $this->render('AdminBundle:EmailTemplate:set.html.twig',array('form' => $form->createView(), 'emailTemplate' => $emailTemplate));
    }
}

public function editEmailTemplateAction(Request $request, $id) {
  $em = $this->getDoctrine()->getManager();
  $emailTemplate = $em->find('AppBundle:EmailTemplate', 1);
  $form = $this->get('form.factory')->create(new EmailTemplateFormType(), $emailTemplate);

  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {
        //  $em->persist($questionAnswer);
    $em->flush();

    $request->getSession()->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
    return $this->redirect($this->generateUrl('show_email_template'));
  }
  else {
    return $this->render('AdminBundle:EmailTemplate:edit.html.twig',array('form' => $form->createView(), 'emailTemplate' => $emailTemplate));
  }
}

}