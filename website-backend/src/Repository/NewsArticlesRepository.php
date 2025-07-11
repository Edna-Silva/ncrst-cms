<?php

namespace App\Repository;

use App\Entity\NewsArticles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NewsArticles>
 *
 * @method NewsArticles|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsArticles|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsArticles[]    findAll()
 * @method NewsArticles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsArticles::class);
    }

    public function add(NewsArticles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NewsArticles $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NewsArticles[] Returns an array of NewsArticles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NewsArticles
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
