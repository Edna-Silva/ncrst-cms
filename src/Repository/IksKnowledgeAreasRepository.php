<?php

namespace App\Repository;

use App\Entity\IksKnowledgeAreas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IksKnowledgeAreas>
 *
 * @method IksKnowledgeAreas|null find($id, $lockMode = null, $lockVersion = null)
 * @method IksKnowledgeAreas|null findOneBy(array $criteria, array $orderBy = null)
 * @method IksKnowledgeAreas[]    findAll()
 * @method IksKnowledgeAreas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IksKnowledgeAreasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IksKnowledgeAreas::class);
    }

    public function add(IksKnowledgeAreas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IksKnowledgeAreas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return IksKnowledgeAreas[] Returns an array of IksKnowledgeAreas objects
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

//    public function findOneBySomeField($value): ?IksKnowledgeAreas
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
