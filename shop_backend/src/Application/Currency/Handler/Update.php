<?php

namespace App\Application\Currency\Handler;

use App\Application\Currency\Repository;
use App\Data\Entity\Currency\Currency;
use App\Infrastructure\NBP\DTO\RatesDTO;

class Update
{
    public function __construct(private readonly Repository $repository)
    {
    }

    public function update(Currency $currency, RatesDTO $dto): void
    {
        $currency->setName($dto->currency);
        $currency->setCode($dto->code);
        $currency->setMid($dto->mid);

        $this->repository->save($currency);
    }
}