<?php
namespace AppBundle\Controller;

use AppBundle\Entity\user;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


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
				$tuser = $repository->findByType('restaurant');
				$form = $this->createFormBuilder() 
		        ->add('Nom', TextType::class, array(
    'required' => false))  
		        ->add('Ville', TextType::class, array(
    'required' => false))
		        ->add('Recherche', SubmitType::class)
		        ->getForm();
		        $form->handleRequest($request);
		        if ($form->isSubmitted() && $form->isValid()){
					$data = $form->getData();
					$name = $data['Nom'];
					$adress = $data['Ville'];
					if(isset($name) && isset($adress)){
						$tuser = $repository->findBy(array('name' => $name, 'type' => 'restaurant'));
					}else if(isset($name)){
						$tuser = $repository->findByName($name);
					}else{
						$tuser = $repository->findByAdress($adress);	
					}
				}
				return $this->render('recherche.html.twig',array('tuser'=>$tuser,'form' => $form->createView()))	;
			}else{
				return $this->render('noaccess.html.twig');
			}
		}else{
			return $this->redirectToRoute('login');
	    }
	}
}