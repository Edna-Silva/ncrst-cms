<?php

namespace App\Repository;

use App\Entity\BiotechLabs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BiotechLabs>
 *
 * @method BiotechLabs|null find($id, $lockMode = null, $lockVersion = null)
 * @method BiotechLabs|null findOneBy(array $criteria, array $orderBy = null)
 * @method BiotechLabs[]    findAll()
 * @method BiotechLabs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiotechLabsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BiotechLabs::class);
    }

    public function add(BiotechLabs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BiotechLabs $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BiotechLabs[] Returns an array of BiotechLabs objects
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

//    public function findOneBySomeField($value): ?BiotechLabs
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
