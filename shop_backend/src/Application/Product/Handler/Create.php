<?php

declare(strict_types=1);

namespace App\Application\Product\Handler;

use App\Application\Common\Handler\FileManager;
use App\Application\Product\DTO\PriceDTO;
use App\Application\Product\DTO\ProductDTO;
use App\Application\Product\Repository;
use App\Data\Embeddable\Money;
use App\Data\Entity\Product\Price;
use App\Data\Entity\Product\Product;

class Create
{
    public function __construct(
        private readonly Repository  $repository,
        private readonly FileManager $fileUploader,
    ) {
    }

    public function create(ProductDTO $dto): void
    {
        $price = $this->createPrice($dto->priceDTO);

        $product = new Product(
            $dto->name,
            $price,
            $dto->category,
            $dto->description,
            $dto->barcode,
        );

        $fileName = $this->fileUploader->upload($dto->image);

        $product->setImage($fileName);

        $price->setProduct($product);

        $this->repository->save($product);
    }

    private function createPrice(PriceDTO $priceDTO): Price
    {
        return new Price(
            new Money(value: $priceDTO->netMoneyDTO->value),
            new Money(value: $priceDTO->grossMoneyDTO->value),
            $priceDTO->vat,
        );
    }
}
