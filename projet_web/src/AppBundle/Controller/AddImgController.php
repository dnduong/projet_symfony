<?php
namespace AppBundle\Controller;

use AppBundle\Entity\image;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File;
use AppBundle\Form\LoginForm;

class AddImgController extends Controller
{
	private function generateUniqueFileName()
	{
		// md5() reduces the similarity of the file names generated by
		// uniqid(), which is based on timestamps
		return md5(uniqid());
	}
	/**
     * @Route("/add_img", name="add_img")
     */
  public function add_imgAction(Request $request)
  {
    $usr= $this->getUser();
    if(isset($usr)){
      $repository = $this->getDoctrine()->getRepository('AppBundle:user');
      $user = $repository->findOneBy(array('username' => $usr->getUsername(), 'type' => 'restaurant'));
      if(isset($user)){
        $usrname = $usr->getUsername();
        $img = new image();
        $img->setOwner($usrname);
        $form = $this->createFormBuilder($img) 
        ->add('image', FileType::class)  
        ->add('Ajouter', SubmitType::class)
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){                     
          $file = $img->getImage();
          $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
          try
          {
             $file->move($this->getParameter('images_directory'), $filename);
          }catch(FileException $e)
          {
          }
          $img->setImage($filename);
          $em = $this->getDoctrine()->getManager();
          $em->persist($img);
          $em->flush();
          return $this->redirectToRoute('homepage');
        }
        return $this->render('addimg.html.twig',array('form' => $form->createView()));
      }else{
        return $this->render('noaccess.html.twig');
      }
    }else{
      return $this->redirectToRoute('login');
    }
  }      
}