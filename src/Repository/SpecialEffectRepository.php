<?php

namespace App\Repository;

use App\Entity\SpecialEffect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpecialEffect|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialEffect|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialEffect[]    findAll()
 * @method SpecialEffect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialEffectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialEffect::class);
    }

    // /**
    //  * @return SpecialEffect[] Returns an array of SpecialEffect objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpecialEffect
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
