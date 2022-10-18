<?php

namespace App\Controller;

use App\Repository\GRUserRepository;
use App\Repository\GRQuizzRepository;
use App\Repository\GRStandRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\GRCheckpointRepository;
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
    public function result(EntityManagerInterface $em, Request $request, GRUserRepository $GRUser, GRQuizzRepository $GRQuizzRepository, GRStandRepository $gRStandRepository, GRCheckpointRepository $GRCheckpoint, string $id): Response
    {
        $user = $this->getUser();
        $standid = $gRStandRepository->findByUUID($id);
        foreach ($standid as $stand) {
            $nom_du_stand = $stand->getNomStand();
        }
        $quizzs = $GRQuizzRepository->findAllByIdJoinedToStand($id);
        $checkpoints = $GRCheckpoint->findByNomStand($nom_du_stand);


        foreach ($checkpoints as $checkpoint) {
            $user_check = $GRUser->find($user);
            $checkpoint->addGRUser($user_check);
        }
        $questions = $request->request;
        $points_du_joueur = 0;
        foreach ($quizzs as $quizz) {
            $the_question = $quizz->getQuestion();
            $points = $quizz->getPoints();
            $reponse = $questions->get($the_question);
            $the_response = $quizz->getBonneReponse();
            if ($reponse === $the_response) {
                $points_du_joueur = $points + $points_du_joueur;
            };
        }
        $classement = $user->getClassement();
        if (empty($classement)) {
            $classement = $points_du_joueur;
            $user->setClassement($classement);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_home');
        } else {
            $classement = $classement + $points_du_joueur;
            $user->setClassement($classement);
            $em->persist($user);
            $em->persist($checkpoint);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('home/quizz.html.twig', [
            'id' => $id,
            'quizzs' => $quizzs
        ]);
    }
}
