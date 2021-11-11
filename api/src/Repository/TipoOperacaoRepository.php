<?php

namespace App\Repository;

use App\Entity\TipoOperacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoOperacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoOperacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoOperacao[]    findAll()
 * @method TipoOperacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoOperacaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoOperacao::class);
    }

    // /**
    //  * @return TipoOperacao[] Returns an array of TipoOperacao objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoOperacao
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
