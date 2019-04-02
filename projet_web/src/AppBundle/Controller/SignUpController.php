<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends Controller
{
    /**
     * @Route("/signup", name="inscription")
     */
    public function sign_upAction(Request $request)
    {
        return $this->render('signup.html.twig');
    }
}