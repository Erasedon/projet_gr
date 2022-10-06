<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RankedController extends AbstractController
{
    #[Route('/classement', name: 'ranked_home')]
    public function ranked(): Response
    {
        return $this->render('home/ranked.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
