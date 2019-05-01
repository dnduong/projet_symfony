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


class TakeDateController extends Controller
{
	 /**
     * @Route("/tdate", name="take_date")
     */
	public function take_dateAction(Request $request){
		$usr= $this->getUser();
		if(isset($usr)){
			$repository = $this->getDoctrine()->getRepository('AppBundle:user');
			$user = $repository->findOneBy(array('username' => $usr->getUsername(), 'type' => 'utilisateur'));
			if(isset($user)){
				$rep = $this->getDoctrine()->getRepository('AppBundle:rdv');
				$trdv = $rep->findByPrenant(NULL);
				return $this->render('takedate.html.twig',array('trdv' => $trdv));
			}else{
				return $this->render('noaccess.html.twig');
			}
		}else{
			$authenticationUtils = $this->get('security.authentication_utils');
	        // get the login error if there is one
	        $error = $authenticationUtils->getLastAuthenticationError();
	        // last username entered by the user
	        $lastUsername = $authenticationUtils->getLastUsername();
	        $form = $this->createForm(LoginForm::class, [
	        	'_username'=>$lastUsername
	        ]);
	        return $this->render(
	            'security/login.html.twig',
	            array(
	                'form' => $form->createView(),
	                'error'         => $error,
	            )
	        );
	    }
	}
	/**
     * @Route("/tdate/{url}", name="take_one_date")
     */
	public function take_one_dateAction ($url, Request $request) {
		$rdv = $this->getDoctrine()->getRepository('AppBundle:rdv')->findOneByUrl($url);
		if (!$rdv) {
       	 throw $this->createNotFoundException('No rdv found at url '.$url);
      	}
      	$form = $this->createFormBuilder()
      		->add('Prendre',SubmitType::class)
      		->getForm();
      	$form->handleRequest($request);
      	if ($form->isSubmitted() && $form->isValid()) {
      		$rdv->setPrenant($this->getUser()->getUsername());
      		$rep = $this->getDoctrine()->getRepository('AppBundle:rdv');
      		$em = $this->getDoctrine()->getManager();
			$em->persist($rdv);
			$em->flush();
			$trdv = $rep->findByPrenant(NULL);
			return $this->render('takedate.html.twig',array('trdv' => $trdv));
      	}
      	return $this->render('takeonedate.html.twig', array('form' => $form->createView()));
	}
}