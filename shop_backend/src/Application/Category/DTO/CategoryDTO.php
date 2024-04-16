<?php

declare(strict_types=1);

namespace App\Application\Category\DTO;

use App\Data\Entity\Category\Category;

class CategoryDTO
{
    public ?string $name = null;
    public ?int $priority = null;

    public static function from(Category $category): self
    {
        $dto = new self();

        $dto->name = $category->getName();
        $dto->priority = $category->getPriority();

        return $dto;
    }
}
