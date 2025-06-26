<?php

namespace App\Repository;

use App\Entity\SciencePrograms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SciencePrograms>
 *
 * @method SciencePrograms|null find($id, $lockMode = null, $lockVersion = null)
 * @method SciencePrograms|null findOneBy(array $criteria, array $orderBy = null)
 * @method SciencePrograms[]    findAll()
 * @method SciencePrograms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScienceProgramsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SciencePrograms::class);
    }

    public function add(SciencePrograms $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SciencePrograms $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SciencePrograms[] Returns an array of SciencePrograms objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SciencePrograms
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
