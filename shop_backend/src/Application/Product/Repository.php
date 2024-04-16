<?php

declare(strict_types=1);

namespace App\Application\Product;

use App\Data\Entity\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $product): void
    {
        $em = $this->getEntityManager();

        $em->persist($product);
        $em->flush();
    }

    public function delete(Product $product): void
    {
        $em = $this->getEntityManager();

        $em->remove($product);
        $em->flush();
    }
}
