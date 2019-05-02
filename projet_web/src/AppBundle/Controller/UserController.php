<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profileAction(Request $request)
    {
        return $this->render('profil.html.twig');
    }
}
