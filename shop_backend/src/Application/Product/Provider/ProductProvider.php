<?php

declare(strict_types=1);

namespace App\Application\Product\Provider;

use App\Application\Product\QueryRepository;
use App\Data\Entity\Product\Product;

class ProductProvider
{
    public function __construct(private readonly QueryRepository $queryRepository)
    {
    }

    public function loadAllForFront(?string $categoryId): array
    {
        return $this->queryRepository->findAllProductsForFront($categoryId);
    }

    public function loadById(string $id): Product
    {
        $product = $this->queryRepository->find($id);

        if (!$product) {
            throw new \InvalidArgumentException('product.validator.notFound');
        }

        return $product;
    }
}
