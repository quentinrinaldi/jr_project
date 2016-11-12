<?php


namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\RecordingFormType;
use AppBundle\Entity\Recording;
use Symfony\Component\HttpFoundation\File\File;

class RecordingController extends Controller
{

  public function selectTvShowAction(Request $request)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:TVShow');
   $tvShows = $repository->findAll();

   return $this->render('AdminBundle:Recording:index.html.twig', array('tvShows' => $tvShows));
 }

public function showAction(Request $request, $tvshowID)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:Recording');
   $recordings = $repository->getRecordings($tvshowID);

   $tvShowRepository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:TVShow');
   $tvShow = $tvShowRepository->find($tvshowID);
   return $this->render('AdminBundle:Recording:recordings.html.twig', array('recordings' => $recordings, 'tvShow' => $tvShow));
 }


 public function addAction(Request $request, $tvshowID) {
  $em = $this->getDoctrine()->getManager();
   $recording = new Recording();
   $form = $this->get('form.factory')->create(new RecordingFormType($em), $recording);

   $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid()) {
    
    $em->persist($recording);
    $em->flush();

    $request->getSession()->getFlashBag()->add('success', 'Annonce bien enregistrée.');
      // On redirige vers la page de visualisation de l'annonce nouvellement créée
    if (tvshowID == null) {
      return $this->redirect($this->generateUrl('admin_recordings'));
    }
    else {
      return $this->redirect($this->generateUrl('show_recordings', array('tvshowID' => $tvshowID)));
    }
  }
  else {
    return $this->render('AdminBundle:Recording:add.html.twig',array('form' => $form->createView(), 'recording' => $recording, 'tvshowID' => $tvshowID));
  }
}
public function removeAction(Request $request, $id) {
  $em = $this->getDoctrine()->getManager();
  $recording = $em->find('AppBundle:Recording', $id);
  $em->remove($recording);
  $em->flush();

  $request->getSession()->getFlashBag()->add('success', 'Annonce bien enregistrée.');

  return $this->redirect($this->generateUrl('admin_recordings'));
    			// return $this->render("AdminBundle:Recording:showAll");
}

public function editAction(Request $request, $id) {
  $em = $this->getDoctrine()->getManager();
  $recording = $em->find('AppBundle:Recording', $id);

      //  $fileName = $recording->getUpload();
       // $recording->setUpload(new File($this->getParameter("uploads_directory").'/'.$fileName));

  $form = $this->get('form.factory')->create(new RecordingFormType($em), $recording);
    //    $em->refresh($recording);
  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {

    $em->flush();

    $request->getSession()->getFlashBag()->add('success', 'Les modifications ont bien été prises en compte.');
    return $this->redirect($this->generateUrl('admin_recordings'));
  }
  else {
    return $this->render('AdminBundle:Recording:edit.html.twig',array('form' => $form->createView(), 'recording' => $recording));
          // return $this->render("AdminBundle:Recording:showAll");
  }
}
}