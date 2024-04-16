<?php

declare(strict_types=1);

namespace App\Application\Product;

use App\Application\Product\Api\ProductsDTO;
use App\Data\Entity\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class QueryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getQueryForListing(): Query
    {
        $qb = $this->createQueryBuilder('p');

        return $qb->getQuery();
    }

    public function findAllProductsForFront(?string $categoryId): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->select('
                p.name,
                p.image,
                price.gross.value,
                price.gross.currency
            ')
            ->leftJoin('p.price', 'price')
        ;

        if ($categoryId) {
            $qb
                ->leftJoin('p.category', 'category')
                ->andWhere('category.name = :categoryId')
                ->setParameter('categoryId', $categoryId)
            ;
        }

        return ProductsDTO::fromCollection($qb->getQuery()->getResult());
    }
}
