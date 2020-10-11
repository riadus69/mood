<?php

namespace App\Controller;



use App\Repository\MoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Response;


class MoodController extends AbstractController
{


    /**
     * @var PropertyRepository
     * @param PropertyRepository $repository
     */
    public function __construct (MoodRepository $repository) {
        $this->repository = $repository;
    }


    /**
     * @Route("/mood", name="mood.index")
     * @return Response
     */
    public function index(): Response {

        /*
        $mood = new Mood();
        $mood->setIduser(1)
            ->setMooduser('happy');
        $this->em->persist($mood);
        $this->em->flush();
        */

        //$mood_user = $this->repository->findOneBy(['iduser' => 2]);
        //dump($mood_user);

        $update_mood = $this->repository->updateMood('2', 'sad');
        dump($update_mood);

        return $this->render('mood/index.html.twig');
        //return new Response('Les moods');
    }
}