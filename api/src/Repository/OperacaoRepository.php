<?php

namespace App\Repository;

use App\Entity\Operacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Operacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Operacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Operacao[]    findAll()
 * @method Operacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperacaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operacao::class);
    }

    // /**
    //  * @return Operacao[] Returns an array of Operacao objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Operacao
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
