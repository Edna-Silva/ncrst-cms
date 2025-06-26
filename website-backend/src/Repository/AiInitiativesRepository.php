<?php

namespace App\Repository;

use App\Entity\AiInitiatives;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AiInitiatives>
 *
 * @method AiInitiatives|null find($id, $lockMode = null, $lockVersion = null)
 * @method AiInitiatives|null findOneBy(array $criteria, array $orderBy = null)
 * @method AiInitiatives[]    findAll()
 * @method AiInitiatives[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AiInitiativesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AiInitiatives::class);
    }

    public function add(AiInitiatives $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AiInitiatives $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AiInitiatives[] Returns an array of AiInitiatives objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AiInitiatives
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
