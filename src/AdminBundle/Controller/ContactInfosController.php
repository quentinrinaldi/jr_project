<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\ContactInfosFormType;
use AppBundle\Entity\ContactInfos;


class ContactInfosController extends Controller
{

  public function showContactInfosAction(Request $request)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:ContactInfos');
   $contactInfos = $repository->findAll();

   if ($contactInfos == null) {
      return $this->addContactInfosAction($request);
   }
   else {
    return $this->editContactInfosAction($request, $contactInfos[0]->getId());
   }  
  }

  public function addContactInfosAction(Request $request) {
    $contactInfos = new ContactInfos();
    $form = $this->get('form.factory')->create(new ContactInfosFormType(), $contactInfos);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($contactInfos);
      $em->flush();

      $request->getSession()->getFlashBag()->add('success', "L'occurence des informations de contact à bien été créée");

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
      return $this->redirect($this->generateUrl('show_contact_infos'));
    }
    else {
      return $this->render('AdminBundle:ContactInfos:set.html.twig',array('form' => $form->createView(), 'contactInfos' => $contactInfos));
    }
}

public function editContactInfosAction(Request $request, $id) {
  $em = $this->getDoctrine()->getManager();
  $contactInfos = $em->find('AppBundle:ContactInfos', 1);
  $form = $this->get('form.factory')->create(new ContactInfosFormType(), $contactInfos);

  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {
        //  $em->persist($questionAnswer);
    $em->flush();

    $request->getSession()->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
    return $this->redirect($this->generateUrl('show_contact_infos'));
  }
  else {
    return $this->render('AdminBundle:ContactInfos:edit.html.twig',array('form' => $form->createView(), 'contactInfos' => $contactInfos));
  }
}

}