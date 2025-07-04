<?php

namespace App\Repository;

use App\Entity\IksIniativeOutcomes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IksIniativeOutcomes>
 *
 * @method IksIniativeOutcomes|null find($id, $lockMode = null, $lockVersion = null)
 * @method IksIniativeOutcomes|null findOneBy(array $criteria, array $orderBy = null)
 * @method IksIniativeOutcomes[]    findAll()
 * @method IksIniativeOutcomes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IksIniativeOutcomesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IksIniativeOutcomes::class);
    }

    public function add(IksIniativeOutcomes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IksIniativeOutcomes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return IksIniativeOutcomes[] Returns an array of IksIniativeOutcomes objects
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

//    public function findOneBySomeField($value): ?IksIniativeOutcomes
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
