<?php

declare(strict_types=1);

namespace App\Application\Category;

use App\Application\AbstractApiController;
use App\Application\Category\Provider\CategoryProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Controller extends AbstractApiController
{
    #[Route('/api/categories', name: 'get_categories', methods: ['GET'])]
    public function categories(CategoryProvider $categoryProvider): JsonResponse
    {
        return $this->successData([
            'categories' => $categoryProvider->loadAllForFront(),
        ]);
    }
}
