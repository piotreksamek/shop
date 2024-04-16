<?php

declare(strict_types=1);

namespace App\Application\Category\Validator;

use App\Application\Category\QueryRepository;

class CheckCategoryHasProducts
{
    public function __construct(
        private readonly QueryRepository $queryRepository
    ) {
    }

    public function execute(string $categoryId): void
    {
        $products = $this->queryRepository->findProductsByCategoryId($categoryId);

        if (!empty($products)) {
            throw new \InvalidArgumentException('category.validator.error.hasProduct');
        }
    }
}
