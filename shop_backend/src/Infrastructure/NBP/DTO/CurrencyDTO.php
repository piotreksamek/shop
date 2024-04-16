<?php

declare(strict_types=1);

namespace App\Infrastructure\NBP\DTO;

class CurrencyDTO
{
    public string $table;
    public string $no;
    public string $effectiveDate;

    /** @var array<int, RatesDTO> */
    public array $rates;
}
