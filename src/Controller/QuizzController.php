<?php

namespace App\Controller;

use App\Repository\GRQuizzRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzController extends AbstractController
{
    #[Route('/quizz/{id}', name: 'quizz_home')]
    public function show(GRQuizzRepository $GRQuizzRepository, string $id): Response
    {

        $GRQuizzs = $GRQuizzRepository->findAllByIdJoinedToStand($id);

        
/*         dd($GRQuizz);
 */


        return $this->render('home/quizz.html.twig', [
            'quizzs' => $GRQuizzs
        ]);
    }
}
