<?php


namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdminBundle\Form\Type\UploadFormType;
use AppBundle\Entity\Upload;
use Symfony\Component\HttpFoundation\File\File;

class UploadController extends Controller
{

	public function showAllAction(Request $request)
  {
   $repository = $this
   ->getDoctrine()
   ->getManager()
   ->getRepository('AppBundle:Upload');
   $uploads = $repository->findAll();

   return $this->render('AdminBundle:Upload:index.html.twig', array('uploads' => $uploads));
 }

  public function addAction(Request $request) {
  $em = $this->getDoctrine()->getManager();
   $upload = new Upload();
   $form = $this->get('form.factory')->create(new UploadFormType($em), $upload);

   $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid()) {
    $upload->setUrl($this->container->get('templating.helper.assets')->getUrl('uploads/'.$upload->getFileName()));
    $em->persist($upload);
    $em->flush();

    $request->getSession()->getFlashBag()->add('success', 'Le fichier a bien été uploadé.');

      // On redirige vers la page de visualisation de l'annonce nouvellement créée
    return $this->redirect($this->generateUrl('admin_uploads'));
    			// return $this->render("AdminBundle:Recording:showAll");
  }
  else {
    return $this->render('AdminBundle:Upload:add.html.twig',array('form' => $form->createView(), 'upload' => $upload));
  }
}

 public function removeAction(Request $request, $id) {
  $em = $this->getDoctrine()->getManager();
  $upload = $em->find('AppBundle:Upload', $id);
  $em->remove($upload);
  $em->flush();

  $request->getSession()->getFlashBag()->add('success', 'Le fichier a bien été supprimé.');

  return $this->redirect($this->generateUrl('admin_uploads'));
}
}