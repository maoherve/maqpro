<?php

namespace App\Repository;

use App\Entity\MakeupProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MakeupProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakeupProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakeupProducts[]    findAll()
 * @method MakeupProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakeupProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MakeupProducts::class);
    }

    // /**
    //  * @return MakeupProducts[] Returns an array of MakeupProducts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MakeupProducts
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
