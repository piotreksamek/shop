<?php

declare(strict_types=1);

namespace App\UI\Form\Transformer;

use App\Application\Common\DTO\MoneyDTO;
use Symfony\Component\Form\DataTransformerInterface;

class MoneyTransformer implements DataTransformerInterface
{
    public function __construct(private readonly string $defaultCurrency = 'PLN')
    {
    }

    public function transform(mixed $value): ?string
    {
        if ($value instanceof MoneyDTO && $value->value !== null) {
            $money = $value;

            return (string) ($money->value / 100);
        }

        return null;
    }

    public function reverseTransform(mixed $value): ?MoneyDTO
    {
        if (is_int($value) || is_float($value)) {
            return new MoneyDTO((int) round($value * 100), $this->defaultCurrency);
        }

        return null;
    }
}
