<?php

declare(strict_types=1);

namespace App\Application\Product\Provider;

use App\Application\Product\QueryRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class PaginatorProvider
{
    public function __construct(
        private readonly PaginatorInterface $paginator,
        private readonly QueryRepository $queryRepository,
    ) {
    }

    public function findByPage(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->queryRepository->getQueryForListing(),
            $page
        );
    }
}
