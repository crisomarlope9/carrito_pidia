<?php

namespace App\Repository;

use App\Entity\CarritoDetalle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarritoDetalle>
 *
 * @method CarritoDetalle|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarritoDetalle|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarritoDetalle[]    findAll()
 * @method CarritoDetalle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarritoDetalleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarritoDetalle::class);
    }

    public function save(CarritoDetalle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarritoDetalle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CarritoDetalle[] Returns an array of CarritoDetalle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarritoDetalle
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
