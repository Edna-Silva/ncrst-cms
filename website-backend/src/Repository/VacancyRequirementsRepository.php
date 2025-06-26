<?php

namespace App\Repository;

use App\Entity\VacancyRequirements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VacancyRequirements>
 *
 * @method VacancyRequirements|null find($id, $lockMode = null, $lockVersion = null)
 * @method VacancyRequirements|null findOneBy(array $criteria, array $orderBy = null)
 * @method VacancyRequirements[]    findAll()
 * @method VacancyRequirements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacancyRequirementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VacancyRequirements::class);
    }

    public function add(VacancyRequirements $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VacancyRequirements $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return VacancyRequirements[] Returns an array of VacancyRequirements objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VacancyRequirements
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
