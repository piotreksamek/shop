<?php

declare(strict_types=1);

namespace App\Application\Category\Handler;

use App\Application\Category\DTO\CategoryDTO;
use App\Application\Category\Repository;
use App\Data\Entity\Category\Category;

class Create
{
    public function __construct(private readonly Repository $repository)
    {
    }

    public function create(CategoryDTO $dto): void
    {
        $category = new Category(
            $dto->name,
            $dto->priority
        );

        $this->repository->save($category);
    }
}
