<?php

namespace App\Repository;

use App\Entity\BoardCommissionerCommittees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BoardCommissionerCommittees>
 *
 * @method BoardCommissionerCommittees|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoardCommissionerCommittees|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoardCommissionerCommittees[]    findAll()
 * @method BoardCommissionerCommittees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoardCommissionerCommitteesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoardCommissionerCommittees::class);
    }

    public function add(BoardCommissionerCommittees $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BoardCommissionerCommittees $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BoardCommissionerCommittees[] Returns an array of BoardCommissionerCommittees objects
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

//    public function findOneBySomeField($value): ?BoardCommissionerCommittees
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
