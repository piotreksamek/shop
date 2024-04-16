<?php

declare(strict_types=1);

namespace App\Application\Product\Handler;

use App\Application\Common\Handler\FileManager;
use App\Application\Product\DTO\PriceDTO;
use App\Application\Product\DTO\ProductDTO;
use App\Application\Product\Repository;
use App\Data\Entity\Product\Price;
use App\Data\Entity\Product\Product;

class Update
{
    public function __construct(
        private readonly Repository  $repository,
        private readonly FileManager $fileUploader,
    ) {
    }

    public function update(Product $product, ProductDTO $dto): void
    {
        $product->setName($dto->name);
        $product->setDescription($dto->description);
        $product->setBarcode($dto->barcode);
        $product->setCategory($dto->category);
        $this->updatePrice($product->getPrice(), $dto->priceDTO);

        $this->repository->save($product);
    }

    private function updatePrice(Price $price, PriceDTO $priceDTO): void
    {
        $price->setNet($priceDTO->netMoneyDTO->toMoney());
        $price->setGross($priceDTO->grossMoneyDTO->toMoney());
        $price->setVat($priceDTO->vat);
    }

    private function handleImage(Product $product, ProductDTO $dto): void
    {
        $fileName = $this->fileUploader->upload($dto->image);
        $product->setImage($fileName);
    }
}
