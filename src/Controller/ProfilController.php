<?php

namespace App\Controller;

use App\Services\User;
use App\Services\UserService;
use App\Security\EmailVerifier;
use App\Repository\GRUserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(GRUserRepository $GRUserRepository): Response
    {
        $GRUser = $GRUserRepository->findAll( array('classement' => 'ASC') );


        return $this->render('profil/index.html.twig', [
            'userlists' => $GRUser,
        ]);
    }
  
    #[Route('/profil/mail_confirmationb', name: 'app_profil_mail_confirmation')]
    public function mail_confirmation(UserService $userService, EmailVerifier $emailVerifier, Request $request): Response
    {
        $userService::envoyerMailConfirmation(request: $request, emailVerifier: $emailVerifier, user: $this->getUser());

        $this->addFlash('success', 'Mail de confirmation envoyé');
        return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
    }
}
