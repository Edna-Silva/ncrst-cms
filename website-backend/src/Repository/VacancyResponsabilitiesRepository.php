<?php

namespace App\Repository;

use App\Entity\VacancyResponsabilities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VacancyResponsabilities>
 *
 * @method VacancyResponsabilities|null find($id, $lockMode = null, $lockVersion = null)
 * @method VacancyResponsabilities|null findOneBy(array $criteria, array $orderBy = null)
 * @method VacancyResponsabilities[]    findAll()
 * @method VacancyResponsabilities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacancyResponsabilitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VacancyResponsabilities::class);
    }

    public function add(VacancyResponsabilities $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VacancyResponsabilities $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return VacancyResponsabilities[] Returns an array of VacancyResponsabilities objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VacancyResponsabilities
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
