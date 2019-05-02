<?php
namespace AppBundle\Controller;

use AppBundle\Entity\user;
use AppBundle\Entity\rdv;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Firewall\ContextListener;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\LoginForm;

class MakeDateController extends Controller
{
	 /**
     * @Route("/mdate", name="make_date")
     */
	public function make_dateAction(Request $request){
		$usr= $this->getUser();
		if(isset($usr)){
			$repository = $this->getDoctrine()->getRepository('AppBundle:user');
			$user = $repository->findOneBy(array('username' => $usr->getUsername(), 'type' => 'restaurant'));
			if(isset($user)){
				$rdv = new rdv();
				$rdv->setProposant($usr->getUsername());
				$rdv->setPrenant(NULL);
				$url = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',2)),0,10);
				$rdv->setUrl($url);
				$form = $this->createFormBuilder($rdv)
				->add('date',DateTimeType::class)
				->add('Ajouter', SubmitType::class)
				->getForm();
				$form->handleRequest($request);
				$rep = $this->getDoctrine()->getRepository('AppBundle:rdv');
				$trdv = $rep->findByProposant($usr->getUsername());
				if ($form->isSubmitted() && $form->isValid()){
					$em = $this->getDoctrine()->getManager();
		            $em->persist($rdv);
		            $em->flush();
		            $trdv = $rep->findByProposant($usr->getUsername());
					return $this->render('makedate.html.twig',array('form' => $form->createView(),'trdv'=> $trdv));
				}
				return $this->render('makedate.html.twig',array('form' => $form->createView(),'trdv'=> $trdv));
			}else{
				return $this->render('noaccess.html.twig');
			}
		}else{
			return $this->redirectToRoute('login');
	    }
	}
}