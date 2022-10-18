<?php

namespace App\Repository;

use App\Entity\GRCheckpoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GRCheckpoint>
 *
 * @method GRCheckpoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method GRCheckpoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method GRCheckpoint[]    findAll()
 * @method GRCheckpoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GRCheckpointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GRCheckpoint::class);
    }

    public function save(GRCheckpoint $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GRCheckpoint $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return GRCheckpoint[] Returns an array of GRCheckpoint objects
     */
    public function findByNomStand($name): array
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.nom_stands = :val')
            ->setParameter('val', $name)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return GRCheckpoint[] Returns an array of GRCheckpoint objects
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

    //    public function findOneBySomeField($value): ?GRCheckpoint
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
