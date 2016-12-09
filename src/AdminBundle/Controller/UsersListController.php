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

 	public function grantAdminRoleAction(Request $request, $id)
	{

		$em = $this->getDoctrine()->getManager();
 		$user = $em->find('UserBundle:User', $id);
 		$user->setRoles(array('ROLE_USER', 'ROLE_ADMIN'));
 		$em->flush();

 		$request->getSession()->getFlashBag()->add('success', 'L\'utilisateur '.$user->getFirstName(). " ".$user->getLastName()." a bien été promu administrateur");

 		return $this->redirect($this->generateUrl('users'));
 	}

 	public function deleteAdminRoleAction(Request $request, $id)
	{

		$em = $this->getDoctrine()->getManager();
 		$user = $em->find('UserBundle:User', $id);
 		$user->setRoles(array('ROLE_USER'));
 		$em->flush();

 		$request->getSession()->getFlashBag()->add('success', 'L\'utilisateur '.$user->getFirstName(). " ".$user->getLastName()." ne possède plus les droits administrateurs");

 		return $this->redirect($this->generateUrl('users'));
 	}


}