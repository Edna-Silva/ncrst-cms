<?php

namespace App\Repository;

use App\Entity\InternshipPrograms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InternshipPrograms>
 *
 * @method InternshipPrograms|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternshipPrograms|null findOneBy(array $criteria, array $orderBy = null)
 * @method InternshipPrograms[]    findAll()
 * @method InternshipPrograms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternshipProgramsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InternshipPrograms::class);
    }

    public function add(InternshipPrograms $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InternshipPrograms $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return InternshipPrograms[] Returns an array of InternshipPrograms objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InternshipPrograms
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
