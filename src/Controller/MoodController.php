<?php

namespace App\Controller;



use App\Helpers\MoodHelper;
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
    public function __construct (MoodRepository $repository, MoodHelper $helper) {
        $this->repository = $repository;
        $this->helper = $helper;
    }

    /**
     * @Route("/mood", name="mood.index")
     * @return Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(): Response {

        $users = $this->repository->getAllUserByMood();

        return $this->render('mood/index.html.twig', [
            'users_sad' => $this->helper->shuffle_assoc($users['sad']),
            'users_happy' => $this->helper->shuffle_assoc($users['happy']),
            'users_very_happy' => $this->helper->shuffle_assoc($users['very happy'])
        ]);

    }


    /**
     * @Route("/mood/ajax", name="update_ajax")
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function ajaxAction(Request $request) {

        $get_id_column = $this->repository->getIdColumn();
        $id_user = $this->get('security.token_storage')->getToken()->getUser()->getId();

        if ($id_user) {
            if ($request->isXMLHttpRequest()) {

                $mood = $this->helper->TransformIdColumnToMood($request->get('grid_id'), $get_id_column);

                if ($mood != null) {
                    $update_mood = $this->repository->updateMood($id_user, $mood);
                    if ($update_mood) {
                        //return new JsonResponse(array('data' => 'this is a json response'));
                        return new JsonResponse(true);
                    }
                }
                else {
                    return new JsonResponse(false);
                }
            } else return new Response('This is not ajax!', 400);
        }

    }


}