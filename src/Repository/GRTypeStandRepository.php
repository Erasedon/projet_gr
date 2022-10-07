<?php

namespace App\Repository;

use App\Entity\GRTypeStand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GRTypeStand>
 *
 * @method GRTypeStand|null find($id, $lockMode = null, $lockVersion = null)
 * @method GRTypeStand|null findOneBy(array $criteria, array $orderBy = null)
 * @method GRTypeStand[]    findAll()
 * @method GRTypeStand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GRTypeStandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GRTypeStand::class);
    }

    public function save(GRTypeStand $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GRTypeStand $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GRTypeStand[] Returns an array of GRTypeStand objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GRTypeStand
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
