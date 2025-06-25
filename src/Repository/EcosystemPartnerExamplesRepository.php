<?php

namespace App\Repository;

use App\Entity\EcosystemPartnerExamples;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EcosystemPartnerExamples>
 *
 * @method EcosystemPartnerExamples|null find($id, $lockMode = null, $lockVersion = null)
 * @method EcosystemPartnerExamples|null findOneBy(array $criteria, array $orderBy = null)
 * @method EcosystemPartnerExamples[]    findAll()
 * @method EcosystemPartnerExamples[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcosystemPartnerExamplesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EcosystemPartnerExamples::class);
    }

    public function add(EcosystemPartnerExamples $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EcosystemPartnerExamples $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EcosystemPartnerExamples[] Returns an array of EcosystemPartnerExamples objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EcosystemPartnerExamples
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
