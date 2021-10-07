<?php

namespace App\Repository;

use App\Entity\MakeupArtist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MakeupArtist|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakeupArtist|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakeupArtist[]    findAll()
 * @method MakeupArtist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakeupArtistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MakeupArtist::class);
    }

    // /**
    //  * @return MakeupArtist[] Returns an array of MakeupArtist objects
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
    public function findOneBySomeField($value): ?MakeupArtist
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
