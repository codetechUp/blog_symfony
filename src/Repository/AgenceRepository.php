<?php

namespace App\Repository;

use App\Entity\Agence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Agence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agence[]    findAll()
 * @method Agence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Agence::class);
    }
    public function Visible(){

        return $this->createQueryBuilder('a')
            ->andWhere('a.sold = false')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;

    }

    // /**
    //  * @return Agence[] Returns an array of Agence objects
    //  */
    /*
    public function findByExampleField($value)
    {
    }
    */

    /*
    
    public function findOneBySomeField($value): ?Agence
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
