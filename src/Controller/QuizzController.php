<?php

namespace App\Controller;

use App\Repository\GRQuizzRepository;
use App\Repository\GRStandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzController extends AbstractController
{
    #[Route('/quizz/{id}', name: 'quizz_home')]
    public function show(GRQuizzRepository $GRQuizzRepository, string $id): Response
    {

        $GRQuizzs = $GRQuizzRepository->findAllByIdJoinedToStand($id);
        shuffle($GRQuizzs);

        if (!$GRQuizzs) {
            throw $this->createNotFoundException(
                'pas de question pour cette ' . $id
            );
        }

        return $this->render('home/quizz.html.twig', [
            'id' => $id,
            'quizzs' => $GRQuizzs
        ]);
    }
    #[Route('/quizz/valide/{id}', name: 'quizz_result')]
    public function result(Request $request, GRQuizzRepository $GRQuizzRepository, string $id): Response
    {

        $quizzs = $GRQuizzRepository->findAllByIdJoinedToStand($id);

        // $test = $request->query;
        // $rep = $test->get('question2');
        // dd($request, $rep, $quizzs);
        // dd($GRQuizzs);



        return $this->render('home/quizz.html.twig', [
            'id' => $id,
            'quizzs' => $quizzs
        ]);
    }
}
