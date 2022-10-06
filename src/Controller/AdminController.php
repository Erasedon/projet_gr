<?php

namespace App\Controller;

use App\Entity\GRStand;
use App\Form\GRStandType;
use App\Services\QrcodeService;
use App\Form\QrcodestandFormType;
use App\Repository\GRUserRepository;
use App\Repository\GRStandRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\GRTypeStandRepository;
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
    public function stand(Request $request, GRStandRepository $grStand, PaginatorInterface $paginator): Response
    {
        $stands = $grStand->findALL();
        $stands = $paginator->paginate(
            $stands,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/stand.html.twig', [
            'stands' => $stands
        ]);
    }
    #[Route('/admin/modif/{id}', name: 'app_modif')]
    public function modif(Request $request, GRStandRepository $GRStandRepository, GRStand $stand, QrcodeService $qrcodeService, EntityManagerInterface $em): Response
    {
        $qrCode = null;
        $form = $this->createForm(GRStandType::class, $stand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $qrCode = $qrcodeService->qrcode($data['uuid']);

            $em->persist($stand);
            $em->flush();
        }

        return $this->render('admin/modif.html.twig', [
            "qrCode" => $qrCode,
            'form' => $form->createView(),
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/create', name: 'app_create')]
    public function create(Request $request, GRStandRepository $GRStandRepository, GRTypeStandRepository $GRType, QrcodeService $qrcodeService, EntityManagerInterface $em): Response
    {
        $qrCode = null;
        $stand = new GRStand();
        $form = $this->createForm(GRStandType::class, $stand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($request);
            $type = $request->get('gr_stand')['Type'];
            $uuid = $request->get('gr_stand')['uuid'];
            $type = $GRType->find($type);
            $stand->setType($type)
                ->setQrCode($uuid);
            $qrCode = $qrcodeService->qrcode($uuid);
            // dd($stand);

            $em->persist($stand);
            $em->flush();
        }

        return $this->render('admin/create.html.twig', [
            "qrCode" => $qrCode,
            'form' => $form->createView(),
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
