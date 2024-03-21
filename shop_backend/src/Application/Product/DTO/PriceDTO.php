<?php

declare(strict_types=1);

namespace App\Application\Product\DTO;

use App\Data\Entity\Embedable\DTO\MoneyDTO;

class PriceDTO
{
    public MoneyDTO $moneyDTO;
}
