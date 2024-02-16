<?php

namespace App\Repository;

use App\Entity\AchatUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AchatUrl>
 *
 * @method AchatUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method AchatUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method AchatUrl[]    findAll()
 * @method AchatUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchatUrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AchatUrl::class);
    }

//    /**
//     * @return AchatUrl[] Returns an array of AchatUrl objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AchatUrl
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
