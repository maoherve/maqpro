<?php

namespace App\Repository;

use App\Entity\MakeupRef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MakeupRef|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakeupRef|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakeupRef[]    findAll()
 * @method MakeupRef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakeupRefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MakeupRef::class);
    }

    // /**
    //  * @return MakeupRef[] Returns an array of MakeupRef objects
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
    public function findOneBySomeField($value): ?MakeupRef
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
