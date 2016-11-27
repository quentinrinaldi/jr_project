<?php
namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use UserBundle\Entity\User;


class UsersListController extends Controller
{
	public function showAllAction(Request $request)
	{
		$repository = $this
		->getDoctrine()
		->getManager()
		->getRepository('UserBundle:User');
		$users = $repository->findAll();

		return $this->render('AdminBundle:UsersList:index.html.twig', array('users' => $users));
	}
	public function removeUserAction(Request $request, $id)
	{

		$em = $this->getDoctrine()->getManager();
 		$user = $em->find('UserBundle:User', $id);
 		$em->remove($user);
 		$em->flush();

 		$request->getSession()->getFlashBag()->add('success', 'L\'utilisateur a bien été supprimé');

 		return $this->redirect($this->generateUrl('users'));
 	}
}