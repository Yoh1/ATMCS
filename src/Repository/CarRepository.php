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

        if(!empty($data->minPrice)){
            $query = $query
                        ->andWhere('c.price >= :minPrice')
                        ->setParameter('minPrice', $data->minPrice);
        }

        if(!empty($data->maxPrice)){
            $query = $query
                        ->andWhere('c.price <= :maxPrice')
                        ->setParameter('maxPrice', $data->maxPrice);
        }
        
        if(!empty($data->minYear)){
            $query = $query
                        ->andWhere('c.year >= :minYear')
                        ->setParameter('minYear', $data->minYear);
        }
        
        if(!empty($data->maxYear)){
            $query = $query
                        ->andWhere('c.year <= :maxYear')
                        ->setParameter('maxYear', $data->maxYear);
        }

        if(!empty($data->minMile)){
            $query = $query
                        ->andWhere('c.mileage >= :minMile')
                        ->setParameter('minMile', $data->minMile);
        }
        
        if(!empty($data->maxMile)){
            $query = $query
                        ->andWhere('c.mileage <= :maxMile')
                        ->setParameter('maxMile', $data->maxMile);
        }

        if(!empty($data->brand)){
            $query = $query
                        ->andWhere('c.brand like :brand')
                        ->setParameter('brand', $data->brand);
        }

        if(!empty($data->model)){
            $query = $query
                        ->andWhere('c.model like :model')
                        ->setParameter('model', $data->model);
        }

        if(!empty($data->location)){
            $query = $query
                        ->andWhere('c.location like :location')
                        ->setParameter('location', $data->location);
        }

        if(!empty($data->engine)){
            $query = $query
                        ->andWhere('c.engine like :engine')
                        ->setParameter('engine', $data->engine);
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
                ->distinct()
                ->orderBy('c.brand', 'ASC');
        
        $query = $query->getQuery()->getScalarResult();

        return array_column($query, "brand");
    }

    /* Prochaine étape une requête
    SELECT brand, count(brand) FROM `car` GROUP BY brand
    pour récuper le nombre de marques en même temps */

    public function findModels(): array {

        $query = $this
                ->createQueryBuilder('c')
                ->select('c.model')
                ->distinct()
                ->orderBy('c.model', 'ASC');
        
        $query = $query->getQuery()->getScalarResult();

        return array_column($query, "model");
    }

    public function findLocations(): array {

        $query = $this
                ->createQueryBuilder('c')
                ->select('c.location')
                ->distinct()
                ->orderBy('c.location', 'ASC');
        
        $query = $query->getQuery()->getScalarResult();

        return array_column($query, "location");
    }

    public function findEngines(): array {

        $query = $this
                ->createQueryBuilder('c')
                ->select('c.engine')
                ->distinct()
                ->orderBy('c.engine', 'ASC');
        
        $query = $query->getQuery()->getScalarResult();

        return array_column($query, "engine");
    }

}