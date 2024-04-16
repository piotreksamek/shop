<?php

declare(strict_types=1);

namespace App\Application\Currency\Handler;

use App\Application\Currency\Repository;
use App\Data\Entity\Currency\Currency;
use App\Infrastructure\NBP\DTO\RatesDTO;

class Create
{
    public function __construct(private readonly Repository $repository)
    {
    }

    public function create(RatesDTO $dto): void
    {
        $currency = $this->createCurrency($dto);

        $this->repository->save($currency);
    }

    private function createCurrency(RatesDTO $dto): Currency
    {
        return new Currency(
            name: $dto->currency,
            code: $dto->code,
            mid: $dto->mid
        );
    }
}
