<?php

declare(strict_types=1);

namespace App\Application\Category;

use App\Data\Entity\Category\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function save(Category $product): void
    {
        $em = $this->getEntityManager();

        $em->persist($product);
        $em->flush();
    }

    public function delete(Category $category): void
    {
        $em = $this->getEntityManager();

        $em->remove($category);
        $em->flush();
    }
}
