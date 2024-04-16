<?php

declare(strict_types=1);

namespace App\Data\Embeddable;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Money
{
    public function __construct(
        #[Column(type: Types::INTEGER)]
        private int $value,
        #[Column(type: Types::STRING, length: 3, nullable: true)]
        private ?string $currency = 'PLN',
    ) {
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
