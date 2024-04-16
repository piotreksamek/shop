<?php

declare(strict_types=1);

namespace App\Application\Category\Api;

use Symfony\Component\Uid\Uuid;

class CategoryDTO
{
    public function __construct(
        public Uuid $id,
        public string $name,
        public int $priority,
    ) {
    }

    public static function fromCollection(array $categories): array
    {
        $results = [];

        foreach ($categories as $category) {
            $results[] = new self(
                id: $category['id'],
                name: $category['name'],
                priority: $category['priority'],
            );
        }

        return $results;
    }
}
