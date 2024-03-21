<?php

declare(strict_types=1);

namespace App\Application\Product\Handler;

use App\Application\Product\DTO\PriceDTO;
use App\Application\Product\DTO\ProductDTO;
use App\Application\Product\Repository;
use App\Data\Entity\Embedable\Money;
use App\Data\Entity\Product\Price;
use App\Data\Entity\Product\Product;

class Create
{
    public function __construct(private readonly Repository $repository)
    {
    }

    public function create(ProductDTO $dto): void
    {
        $product = new Product(
            $dto->name,
            $dto->description,
            $this->createPrice($dto->priceDTO)
        );

        $this->repository->save($product);
    }

    private function createPrice(PriceDTO $priceDTO): Price
    {
        return new Price(
            new Money(value: $priceDTO->moneyDTO->value),
            $priceDTO->moneyDTO->currency,
        );
    }
}
