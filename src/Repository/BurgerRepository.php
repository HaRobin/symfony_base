<?php

namespace App\Repository;

use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    //    /**
    //     * @return Burger[] Returns an array of Burger objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Burger
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function findByIngredient(string $ingredient)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.oignon', 'o')
            ->innerJoin('b.pain', 'p')
            ->innerJoin('b.sauces', 's')
            ->andWhere('LOWER(o.name) LIKE LOWER(:ingredient) OR LOWER(p.name) LIKE LOWER(:ingredient) OR LOWER(s.name) LIKE LOWER(:ingredient)')
            ->setParameter('ingredient', '%' . $ingredient . '%')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByExpensive(int $limit)
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.price', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByWithoutIngredient(string $ingredient)
    {
        $sub = $this->createQueryBuilder('sub')
            ->select('sub.id')
            ->innerJoin('sub.sauces', 's')
            ->andWhere('LOWER(s.name) LIKE LOWER(:ingredient)');

        return $this->createQueryBuilder('b')
            ->innerJoin('b.oignon', 'o')
            ->innerJoin('b.pain', 'p')
            ->andWhere('LOWER(o.name) NOT LIKE LOWER(:ingredient) AND LOWER(p.name) NOT LIKE LOWER(:ingredient)')
            ->andWhere($this->getEntityManager()->createQueryBuilder()->expr()->notIn('b.id', $sub->getDQL()))
            ->groupBy('b.id')
            ->setParameter('ingredient', '%' . $ingredient . '%')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByAmountOfIngredients(int $amount)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.oignon', 'o')
            ->innerJoin('b.pain', 'p')
            ->innerJoin('b.sauces', 's')
            ->having('COUNT(DISTINCT s) + COUNT(DISTINCT o) + COUNT(DISTINCT p) = :amount')
            ->groupBy('b.id')
            ->setParameter('amount', $amount)
            ->getQuery()
            ->getResult()
        ;
    }
}
