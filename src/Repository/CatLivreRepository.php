<?php

namespace App\Repository;

use App\Entity\CatLivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatLivre>
 *
 * @method CatLivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatLivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatLivre[]    findAll()
 * @method CatLivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatLivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatLivre::class);
    }

//    /**
//     * @return CatLivre[] Returns an array of CatLivre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CatLivre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
