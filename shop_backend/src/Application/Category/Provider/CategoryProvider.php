<?php

declare(strict_types=1);

namespace App\Application\Category\Provider;

use App\Application\Category\QueryRepository;
use App\Data\Entity\Category\Category;

class CategoryProvider
{
    public function __construct(private readonly QueryRepository $queryRepository)
    {
    }

    public function loadById(string $id): Category
    {
        $category = $this->queryRepository->find($id);

        if (!$category) {
            throw new \InvalidArgumentException();
        }

        return $category;
    }

    public function loadAllForFront(): array
    {
        return $this->queryRepository->findAllCategoriesForFront();
    }
}
