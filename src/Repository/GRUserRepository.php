<?php

namespace App\Repository;

use App\Entity\GRUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<GRUser>
 *
 * @method GRUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method GRUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method GRUser[]    findAll()
 * @method GRUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GRUserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GRUser::class);
    }

    public function save(GRUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GRUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof GRUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }
    /**
     * @return GRUser[] Returns an array of GRUser objects
     */
    public function findByBanned($banned): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.Banned = :val')
            ->setParameter('val', $banned)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAllUserThanRank(int $classement): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u.nom,u.
            FROM App\Entity\GRUser u
            WHERE u.classement > :classement
            ORDER BY u.classement ASC'
        )->setParameter('classement', $classement);

        // returns an array of Product objects
        return $query->getResult();
    }

    //    /**
    //     * @return GRUser[] Returns an array of GRUser objects
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

    //    public function findOneBySomeField($value): ?GRUser
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
