<?php

declare(strict_types=1);

namespace App\Infrastructure\NBP\DTO;

class RatesDTO
{
    public string $currency;
    public string $code;
    public float $mid;
}
