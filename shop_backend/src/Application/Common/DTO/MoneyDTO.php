<?php

declare(strict_types=1);

namespace App\Application\Common\DTO;

use App\Data\Embeddable\Money;

class MoneyDTO
{
    public function __construct(
        public ?int $value = null,
        public ?string $currency = 'PLN',
    ) {
    }

    public static function from(Money $money): self
    {
        $dto = new self();

        $dto->value = $money->getValue();
        $dto->currency = $money->getCurrency();

        return $dto;
    }

    public function toMoney(): Money
    {
        return new Money($this->value ?? 0, $this->currency);
    }
}
