<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/stand', name: 'app_stand')]
    public function stand(): Response
    {
        return $this->render('admin/stand.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/create', name: 'app_create')]
    public function create(): Response
    {
        return $this->render('admin/create.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
