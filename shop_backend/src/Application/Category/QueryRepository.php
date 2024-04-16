<?php

declare(strict_types=1);

namespace App\Application\Category;

use App\Application\Category\Api\CategoryDTO;
use App\Data\Entity\Category\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class QueryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getQueryForListing(): Query
    {
        $qb = $this->createQueryBuilder('c');

        return $qb->getQuery();
    }

    public function findProductsByCategoryId(string $categoryId): array
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('product.id')
            ->andWhere('c.id = :categoryId')
            ->leftJoin('c.product', 'product')
            ->setParameter('categoryId', $categoryId)
            ;

        return $qb->getQuery()->getResult();
    }

    public function findAllCategoriesForFront(): array
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->select('
                c.id,
                c.name,
                c.priority
            ')
        ;

        return CategoryDTO::fromCollection($qb->getQuery()->getResult());
    }
}
