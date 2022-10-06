<?php

namespace App\Controller;

use App\Entity\GRQuizz;
use App\Entity\GRStand;
use App\Form\GRQuizzType;
use App\Form\GRStandType;
use App\Services\QrcodeService;
use App\Form\QrcodestandFormType;
use App\Repository\GRUserRepository;
use App\Repository\GRQuizzRepository;
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
    public function modif(Request $request, GRStandRepository $GRStandRepository, GRTypeStandRepository $GRType, GRStand $stand, QrcodeService $qrcodeService, EntityManagerInterface $em): Response
    {
        $qrCode = null;
        $form = $this->createForm(GRStandType::class, $stand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $type = $request->get('gr_stand')['Type'];
            $type = $GRType->find($type);
            $stand->setType($type);

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
            $type = $request->get('gr_stand')['Type'];
            $uuid = $request->get('gr_stand')['uuid'];
            $type = $GRType->find($type);
            $stand->setType($type)
                ->setQrCode($uuid);
            $qrCode = $qrcodeService->qrcode($uuid);

            $em->persist($stand);
            $em->flush();
        }

        return $this->render('admin/create.html.twig', [
            "qrCode" => $qrCode,
            'form' => $form->createView(),
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/quizz', name: 'app_quizz')]
    public function quizz(Request $request, GRQuizzRepository $GRQuizz, PaginatorInterface $paginator): Response
    {
        $quizzs = $GRQuizz->findALL();
        $quizzs = $paginator->paginate(
            $quizzs,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/quizz.html.twig', [
            'quizzs' => $quizzs
        ]);
    }
    #[Route('/admin/quizz/create', name: 'app_create_quizz')]
    public function create_quizz(Request $request, GRStandRepository $StandRepo, EntityManagerInterface $em): Response
    {
        $quizz = new GRQuizz();
        $form = $this->createForm(GRQuizzType::class, $quizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stand_id = $request->get('gr_quizz')['GRStand'];
            $stand = $StandRepo->find($stand_id);
            $image = $form->get('GRImage')->getData();
            if ($image != null) {
                // on genere un new nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                // on copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // on stocke l'image dans la BDD (son nom)

                $quizz->setImage($fichier);
            }
            $quizz->setGRStand($stand);
            $em->persist($quizz);
            $em->flush();
        }

        return $this->render('admin/createquizz.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/quizz/modif/{id}', name: 'app_quizz_modif')]
    public function quizz_modif(Request $request, $id, GRStandRepository $StandRepo, GRQuizz $quizz, GRQuizzRepository $QuizzRepo, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(GRQuizzType::class, $quizz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stand_id = $request->get('gr_quizz')['GRStand'];
            $stand = $StandRepo->find($stand_id);
            $image = $form->get('GRImage')->getData();
            if ($image != null) {
                // on genere un new nom de fichier
                $fichier = $QuizzRepo->find($id)->getImage();
                // on copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // on stocke l'image dans la BDD (son nom)

                $quizz->setImage($fichier);
            }
            $quizz->setGRStand($stand);
            $em->persist($quizz);
            $em->flush();
        }

        return $this->render('admin/createquizz.html.twig', [
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
