<?php

declare(strict_types=1);

namespace App\Application\Product\Handler;

use App\Application\Common\Handler\FileManager;
use App\Application\Product\Repository;
use App\Data\Entity\Product\Product;

class Delete
{
    public function __construct(
        private readonly Repository $repository,
        private readonly FileManager $fileManager,
    ) {
    }

    public function delete(Product $product): void
    {
        $this->fileManager->remove($product->getImage());

        $this->repository->delete($product);
    }
}
