<?php

declare(strict_types=1);

namespace App\Application\Product\DTO;

class ProductDTO
{
    public string $name;
    public string $description;
    public PriceDTO $priceDTO;
}
