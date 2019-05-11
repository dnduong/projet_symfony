<?php
namespace AppBundle\Controller;

use AppBundle\Entity\user;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Firewall\ContextListener;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Form\LoginForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RechercheController extends Controller
{
	/**
     * @Route("/search", name="recherche")
     */	
	public function rechercheAction(Request $request){
		$usr= $this->getUser();
		if(isset($usr)){
			$repository = $this->getDoctrine()->getRepository('AppBundle:user');
			$user = $repository->findOneBy(array('username' => $usr->getUsername(), 'type' => 'utilisateur'));
			if(isset($user)){
				return $this->render('recherche.html.twig');
			}else{
				return $this->render('noaccess.html.twig');
			}
		}else{
			return $this->redirectToRoute('login');
	    }
	}
}