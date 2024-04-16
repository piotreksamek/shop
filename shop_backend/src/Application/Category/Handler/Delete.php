<?php

namespace App\Application\Category\Handler;

use App\Application\Category\Repository;
use App\Application\Category\Validator\CheckCategoryHasProducts;
use App\Data\Entity\Category\Category;

class Delete
{
    public function __construct(
        private readonly Repository $repository,
        private readonly CheckCategoryHasProducts $checkCategoryHasProducts,
    ) {
    }

    public function delete(Category $category): void
    {
        $this->checkCategoryHasProducts->execute($category->getId());

        $this->repository->delete($category);
    }
}
