<?php

declare(strict_types=1);

namespace App\Application\Category\Provider;

use App\Application\Category\QueryRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class PaginatorProvider
{
    public function __construct(
        private readonly QueryRepository $queryRepository,
        private readonly PaginatorInterface $paginator,
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
