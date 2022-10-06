<?php
namespace App\Controller;

use App\Entity\GRStand;
use App\Repository\GRStandRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzController extends AbstractController
{
    #[Route('/quizz/{id}', name: 'quizz_home')]
    public function show(GRStandRepository $GRstandRepository, string $id): Response
    {

        $GRStand = $GRstandRepository->findOneByIdJoinedToQuizz($id);

        $GRQuizz = $GRStand->getGRQuizz();

/*         dd($GRQuizz);
 */
        return $this->render('home/quizz.html.twig', [
            'quizz' => $GRQuizz
        ]);
    }

}
