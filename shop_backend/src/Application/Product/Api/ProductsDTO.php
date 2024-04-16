<?php

declare(strict_types=1);

namespace App\Application\Product\Api;

use App\Application\Common\DTO\MoneyDTO;
use App\Data\Embeddable\Money;

class ProductsDTO
{
    public function __construct(
        public string $name,
        public string $image,
//        public ?string $description,
        public MoneyDTO $grossValue,
    ) {
    }

    public static function fromCollection(array $products): array
    {
        $results = [];

        foreach ($products as $product) {
            $results[] = new self(
                $product['name'],
                $product['image'],
                MoneyDTO::from(new Money($product['gross.value'], $product['gross.currency'])),
            );
        }

        return $results;
    }
}
