<?php

namespace App\Repository;

use App\Entity\ResearchPriorities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResearchPriorities>
 *
 * @method ResearchPriorities|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResearchPriorities|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResearchPriorities[]    findAll()
 * @method ResearchPriorities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResearchPrioritiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResearchPriorities::class);
    }

    public function add(ResearchPriorities $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ResearchPriorities $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ResearchPriorities[] Returns an array of ResearchPriorities objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ResearchPriorities
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
