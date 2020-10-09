<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home")
     * @return Response
     * :Response n'impacte pas la compilation, juste pour savoir que cette méthode me rend une réponse
     */
    public function index(): Response {
        return $this->render('pages/home.html.twig');
    }
}