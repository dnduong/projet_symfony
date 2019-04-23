<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserControllerImages extends Controller
{
    /**
     * @Route("/profil/images", name="images")
     */
    public function indexAction(Request $request)
    {
        return $this->render('profilimages.html.twig');
    }
}
