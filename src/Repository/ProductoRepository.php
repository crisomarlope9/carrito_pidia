<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Producto>
 *
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }
    public function productosPopulares(int $numeroElementos ):array
    {
        return $this->createQueryBuilder('producto')
            ->select('producto')
            ->join('producto.categoria','categoria')
            ->where('producto.precio>100')
            //->andWhere('categoria.id =3')
            ->setMaxResults($numeroElementos)
            ->getQuery()
            ->getResult()
            ;
    }
    public function productosPopularesOptimizado(int $numeroElementos ):array
    {
        return $this->createQueryBuilder('producto')
            ->select('producto.nombre as productoNombre')
            ->addSelect('producto.id as productoId')
            ->addSelect('producto.precio as productoPrecio')
            ->addSelect('foto.secure as fotoNombre')
            ->join('producto.categoria','categoria')
            ->join('producto.foto','foto')
            ->where('producto.precio>100')
            ->setMaxResults($numeroElementos)
            ->getQuery()
            ->getResult()
            ;

    }

    public function save(Producto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Producto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Producto[] Returns an array of Producto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Producto
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
