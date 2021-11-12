<?php

namespace App\Repository;

use App\Entity\Car;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;

use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use ProxyManager\Stub\EmptyClassStub;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{

    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Car::class);
        $this->paginator = $paginator;
    }

    // /**
    //  * @return Car[] Returns an array of Car objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Car
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

     /**
     * @return PaginationInteface
     */

    public function findSearch(SearchData $data) : PaginationInterface{

        $query = $this
                    ->createQueryBuilder('c')
                    ->select('c');
                    
        if(!empty($data->q)) {
            $query = $query
                        ->andWhere('c.brand LIKE :q')
                        ->orWhere('c.model LIKE :q')
                        ->setParameter('q', "%{$data->q}%");
        }

        if(!empty($data->min)){
            $query = $query
                        ->andWhere('c.price >= :min')
                        ->setParameter('min', $data->min);
        }

        if(!empty($data->max)){
            $query = $query
                        ->andWhere('c.price <= :max')
                        ->setParameter('max', $data->max);
        }

        if(!empty($data->brand)){
            $query = $query
                        ->andWhere('c.brand like :brand')
                        ->setParameter('brand', $data->brand);
        }


        $query = $query->getQuery();
        //return $query->getQuery()->getResult();

        return $this->paginator->paginate(
            $query,
            $data->page,
            15
        );
    }


    public function findBrands(): array {

        $query = $this
                ->createQueryBuilder('c')
                ->select('c.brand')
                ->distinct();
        
        $query = $query->getQuery()->getScalarResult();

        return array_column($query, "brand");
    }

    /* Prochaine étape une requête
    SELECT brand, count(brand) FROM `car` GROUP BY brand
    pour récuper le nombre de marques en même temps */
}
