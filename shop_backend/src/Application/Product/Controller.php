<?php

declare(strict_types=1);

namespace App\Application\Product;

use App\Application\AbstractApiController;
use App\Application\Product\Provider\ProductProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Controller extends AbstractApiController
{
    #[Route('/api/products', name: 'get_orders', methods: ['GET'])]
    public function products(Request $request, ProductProvider $productProvider): JsonResponse
    {
        $categoryId = $request->get('category');

        return $this->successData([
            'products' => $productProvider->loadAllForFront($categoryId)
        ]);
    }
}
