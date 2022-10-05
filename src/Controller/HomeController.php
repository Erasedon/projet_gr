<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/quizz', name: 'quizz_home')]
    public function quizz(): Response
    {
        return $this->render('home/quizz.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    #[Route('/classement', name: 'ranked_home')]
    public function ranked(): Response
    {
        return $this->render('home/ranked.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
