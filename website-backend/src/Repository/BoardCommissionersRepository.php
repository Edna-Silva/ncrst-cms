<?php

namespace App\Repository;

use App\Entity\BoardCommissioners;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoardCommissioners>
 *
 * @method BoardCommissioners|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoardCommissioners|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoardCommissioners[]    findAll()
 * @method BoardCommissioners[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoardCommissionersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoardCommissioners::class);
    }

    public function add(BoardCommissioners $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BoardCommissioners $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BoardCommissioners[] Returns an array of BoardCommissioners objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BoardCommissioners
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
