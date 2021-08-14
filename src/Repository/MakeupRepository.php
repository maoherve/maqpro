<?php

namespace App\Repository;

use App\Entity\Makeup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Makeup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Makeup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Makeup[]    findAll()
 * @method Makeup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakeupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Makeup::class);
    }

    public function findByASC(): array
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }

    // /**
    //  * @return Makeup[] Returns an array of Makeup objects
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
    public function findOneBySomeField($value): ?Makeup
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
