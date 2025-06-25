<?php

namespace App\Repository;

use App\Entity\EcosystemPartners;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EcosystemPartners>
 *
 * @method EcosystemPartners|null find($id, $lockMode = null, $lockVersion = null)
 * @method EcosystemPartners|null findOneBy(array $criteria, array $orderBy = null)
 * @method EcosystemPartners[]    findAll()
 * @method EcosystemPartners[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcosystemPartnersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EcosystemPartners::class);
    }

    public function add(EcosystemPartners $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EcosystemPartners $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EcosystemPartners[] Returns an array of EcosystemPartners objects
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

//    public function findOneBySomeField($value): ?EcosystemPartners
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
