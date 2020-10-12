<?php

namespace App\Controller;



use App\Repository\MoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Response;


class MoodController extends AbstractController
{


    /**
     * MoodController constructor.
     * @param MoodRepository $repository
     */
    public function __construct (MoodRepository $repository) {
        $this->repository = $repository;
    }


    /**
     * @Route("/mood", name="mood.index")
     * @return Response
     */
    public function index(): Response {

        dump($this->repository->getIdColumn());
        dump($this->repository->getAllUserByMood());

        /**
         * get mood user by id grid
         */
        $request = 1;
        $get_id_column = $this->repository->getIdColumn();
        if (false !== $key = array_search($request, $get_id_column)) {
            dump($key);
        } else {
            // do something else
            // return false;
            dump('');
        }

        return $this->render('mood/index.html.twig');
        //return new Response('Les moods');
    }


    /**
     * * @Route("/ajax", name="update_ajax")
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function ajaxAction(Request $request) {
        if ($request->isXMLHttpRequest()) {
            $update_mood = $this->repository->updateMood('2', $request->get('grid_id'));
            if($update_mood) {
               //return new JsonResponse(array('data' => 'this is a json response'));
               return new JsonResponse(true);
            } else {
                return new JsonResponse(false);
            }
        }

        return new Response('This is not ajax!', 400);
    }


}