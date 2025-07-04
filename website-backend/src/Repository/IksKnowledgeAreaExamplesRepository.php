<?php

namespace App\Repository;

use App\Entity\IksKnowledgeAreaExamples;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IksKnowledgeAreaExamples>
 *
 * @method IksKnowledgeAreaExamples|null find($id, $lockMode = null, $lockVersion = null)
 * @method IksKnowledgeAreaExamples|null findOneBy(array $criteria, array $orderBy = null)
 * @method IksKnowledgeAreaExamples[]    findAll()
 * @method IksKnowledgeAreaExamples[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IksKnowledgeAreaExamplesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IksKnowledgeAreaExamples::class);
    }

    public function add(IksKnowledgeAreaExamples $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IksKnowledgeAreaExamples $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return IksKnowledgeAreaExamples[] Returns an array of IksKnowledgeAreaExamples objects
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

//    public function findOneBySomeField($value): ?IksKnowledgeAreaExamples
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
