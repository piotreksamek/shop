<?php

declare(strict_types=1);

namespace App\Application\Product\DTO;


use App\Application\Common\DTO\MoneyDTO;
use App\Data\Entity\Product\Price;

class PriceDTO
{
    public MoneyDTO $netMoneyDTO;
    public MoneyDTO $grossMoneyDTO;
    public int $vat;

    public static function from(Price $price): self
    {
        $dto = new self();

        $dto->netMoneyDTO = MoneyDTO::from($price->getNet());
        $dto->grossMoneyDTO = MoneyDTO::from($price->getGross());
        $dto->vat = $price->getVat();

        return $dto;
    }
}
