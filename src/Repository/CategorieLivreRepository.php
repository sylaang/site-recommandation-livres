<?php

namespace App\Repository;

use App\Entity\CategorieLivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieLivre>
 *
 * @method CategorieLivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieLivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieLivre[]    findAll()
 * @method CategorieLivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieLivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieLivre::class);
    }

//    /**
//     * @return CategorieLivre[] Returns an array of CategorieLivre objects
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

//    public function findOneBySomeField($value): ?CategorieLivre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
