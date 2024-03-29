<?php

namespace App\Repository;

use App\Entity\Quack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Quack|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quack|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuackRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Quack::class);
    }


    /**
     * @return Query
     */
    public function findAllDesc():Query
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.id','DESC')
            ->getQuery();
    }


    /**
     * @param $value
     * @return Quack[]
     */
    public function findByAuthor($value){
        return $this->createQueryBuilder('q')
            ->andWhere('q.author = :val')
            ->setParameter('val', $value)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }


    /**
     * @return Quack[]
     */
    public function findLatest(): array
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.id', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return Quack[] Returns an array of Quack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Quack
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
