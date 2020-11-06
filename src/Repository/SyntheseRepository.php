<?php

namespace App\Repository;

use App\Entity\Synthese;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Synthese|null find($id, $lockMode = null, $lockVersion = null)
 * @method Synthese|null findOneBy(array $criteria, array $orderBy = null)
 * @method Synthese[]    findAll()
 * @method Synthese[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SyntheseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Synthese::class);
    }

    // /**
    //  * @return Synthese[] Returns an array of Synthese objects
    //  */
    
    public function findByOrderedDate($value1,$value2)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.createdAt > :val1')
            ->andWhere('s.createdAt < :val2')
            ->setParameter('val1', $value1)
            ->setParameter('val2',$value2)
            ->orderBy('s.createdAt', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Synthese
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
