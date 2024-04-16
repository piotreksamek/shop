<?php

declare(strict_types=1);

namespace App\Application\Currency\Provider;

use App\Application\Currency\QueryRepository;
use App\Data\Entity\Currency\Currency;

class CurrencyProvider
{
    public function __construct(private readonly QueryRepository $queryRepository)
    {
    }

    public function loadByCode(string $code): Currency
    {
        $currency = $this->queryRepository->findOneBy(['code' => $code]);

        if (!$currency) {
            throw new \InvalidArgumentException('nie ma');
        }

        return $currency;
    }
}
