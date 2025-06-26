<?php

namespace App\Repository;

use App\Entity\BiotechLabServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BiotechLabServices>
 *
 * @method BiotechLabServices|null find($id, $lockMode = null, $lockVersion = null)
 * @method BiotechLabServices|null findOneBy(array $criteria, array $orderBy = null)
 * @method BiotechLabServices[]    findAll()
 * @method BiotechLabServices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiotechLabServicesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BiotechLabServices::class);
    }

    public function add(BiotechLabServices $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BiotechLabServices $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BiotechLabServices[] Returns an array of BiotechLabServices objects
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

//    public function findOneBySomeField($value): ?BiotechLabServices
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
