<?php

namespace App\Repository;

use App\Entity\InnovationChallenges;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InnovationChallenges>
 *
 * @method InnovationChallenges|null find($id, $lockMode = null, $lockVersion = null)
 * @method InnovationChallenges|null findOneBy(array $criteria, array $orderBy = null)
 * @method InnovationChallenges[]    findAll()
 * @method InnovationChallenges[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InnovationChallengesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InnovationChallenges::class);
    }

    public function add(InnovationChallenges $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InnovationChallenges $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return InnovationChallenges[] Returns an array of InnovationChallenges objects
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

//    public function findOneBySomeField($value): ?InnovationChallenges
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
