<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends Controller
{
    /**
   * @Route("/login", name="login")
   */
  public function loginAction(Request $request)
  {
    $user = $this->getUser();
    if ($user instanceof UserInterface) {
      return $this->redirectToRoute('homepage');
    }

    /** @var AuthenticationException $exception */
    $exception = $this->get('security.authentication_utils')
      ->getLastAuthenticationError();

    return $this->render('login.html.twig', [
      'error' => $exception ? $exception->getMessage() : NULL,
    ]);
  }
}