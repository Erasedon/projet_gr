<?php

namespace App\Controller;

use App\Services\QrcodeService;
use App\Form\QrcodestandFormType;
use App\Repository\GRUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request, GRUserRepository $grUserRepository, PaginatorInterface $paginator,): Response
    {
        $users = $grUserRepository->findByBanned(0);
        $users = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/stand', name: 'app_stand')]
    public function stand(Request $request, QrcodeService $qrcodeService): Response
    {

        $qrCode = null;
        $form = $this->createForm(QrcodestandFormType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $qrCode = $qrcodeService->qrcode($data['nomstand']);
        }

        return $this->render('admin/stand.html.twig', [
            'form' => $form->createView(),
            'qrCode' => $qrCode
        ]);
       
    }
    #[Route('/admin/create', name: 'app_create')]
    public function create(): Response
    {
        return $this->render('admin/create.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    
    #[Route('/admin/block/{id}', name: 'app_block')]
    public function block($id, GRUserRepository $gRUserRepository, EntityManagerInterface $em)
    {
        $user = $gRUserRepository->find($id);
        $user->setBanned(1);

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }
}
