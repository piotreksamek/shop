<?php

declare(strict_types=1);

namespace App\Application\Category\Handler;

use App\Application\Category\DTO\CategoryDTO;
use App\Application\Category\Repository;
use App\Data\Entity\Category\Category;

class Update
{
    public function __construct(private readonly Repository $repository)
    {
    }

    public function update(Category $category, CategoryDTO $dto): void
    {
        $category->setName($dto->name);
        $category->setPriority($dto->priority);

        $this->repository->save($category);
    }
}
