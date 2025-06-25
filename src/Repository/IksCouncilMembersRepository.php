<?php

namespace App\Repository;

use App\Entity\IksCouncilMembers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IksCouncilMembers>
 *
 * @method IksCouncilMembers|null find($id, $lockMode = null, $lockVersion = null)
 * @method IksCouncilMembers|null findOneBy(array $criteria, array $orderBy = null)
 * @method IksCouncilMembers[]    findAll()
 * @method IksCouncilMembers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IksCouncilMembersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IksCouncilMembers::class);
    }

    public function add(IksCouncilMembers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IksCouncilMembers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return IksCouncilMembers[] Returns an array of IksCouncilMembers objects
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

//    public function findOneBySomeField($value): ?IksCouncilMembers
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
