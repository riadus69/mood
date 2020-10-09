<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Response;


class MoodController extends AbstractController
{


    /**
     * @Route("/mood", name="mood.index")
     * @return Response
     */
    public function index(): Response {
        return $this->render('mood/index.html.twig');
        //return new Response('Les moods');
    }
}