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
}