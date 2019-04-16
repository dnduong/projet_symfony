<?php
namespace AppBundle\Controller;

use AppBundle\Entity\user;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class SignUpController extends Controller
{
	/**
     * @Route("/signup", name="inscription")
     */
	public function sign_upAction(){
		return $this->render('signup.html.twig');
	}
    /**
     * @Route("/signup_user", name="signup_user")
     */
    public function signup_userAction(Request $request)
    {
    	$user = new user();
    	$user->setType('utilisateur');
    	$form = $this->createFormBuilder($user)
    	->add('Login',TextType::class)
    	->add('Mdp', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
        ])
    	->add('Nom',TextType::class)
    	->add('Prenom',TextType::class)
    	->add('Numero',TelType::class, ['label'=>'Tél'])
    	->add('Adresse',EmailType::class, ['label'=>'Email'])
    	->add('S\'inscrire', SubmitType::class)
       	->getForm();
       	$form->handleRequest($request);
       	if ($form->isSubmitted() && $form->isValid()){
       		$em = $this->getDoctrine()->getManager();
       		$em->persist($user);
       		$em->flush();
       		return $this->render('home.html.twig');
       	}
        return $this->render('signup_user.html.twig',array('form' => $form->createView()));
    }
     /**
     * @Route("/signup_resto", name="signup_resto")
     */
    public function signup_restoAction(Request $request)
    {
    	$user = new user();
    	$user->setType('restaurant');
    	$form = $this->createFormBuilder($user)
    	->add('Login',TextType::class)
    	->add('Mdp', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
        ])
    	->add('Nom',TextType::class, ['label'=>'Nom du restaurat'])
    	->add('Numero',TelType::class, ['label'=>'Tél'])
    	->add('Adresse',TextType::class, ['label'=>'Adresse du restaurant'])
    	->add('S\'inscrire', SubmitType::class)
       	->getForm();
       	$form->handleRequest($request);
       	if ($form->isSubmitted() && $form->isValid()){
       		$em = $this->getDoctrine()->getManager();
       		$em->persist($user);
       		$em->flush();
       		return $this->render('home.html.twig');
       	}
        return $this->render('signup_user.html.twig',array('form' => $form->createView()));
    }
}