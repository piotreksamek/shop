<?php

declare(strict_types=1);

namespace App\Application\Product\DTO;

use App\Data\Entity\Category\Category;
use App\Data\Entity\Product\Product;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductDTO
{
    public UploadedFile $image;
    public string $name;
    public PriceDTO $priceDTO;
    public ?string $description = null;
    public ?string $barcode = null;
    public ?Category $category = null;

    public static function from(Product $product): self
    {
        $dto = new self();

        $dto->name = $product->getName();
        $dto->priceDTO = PriceDTO::from($product->getPrice());
        $dto->description = $product->getDescription();
        $dto->barcode = $product->getBarcode();
        $dto->image = new UploadedFile('uploads/' .$product->getImage(), 'image.jpg');
        $dto->category = $product->getCategory();

        return $dto;
    }
}
