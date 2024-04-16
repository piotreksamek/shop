<?php

namespace App\UI\Twig\RuntimeExtension;

use App\Data\Embeddable\Money;
use Twig\Environment;
use Twig\Extension\RuntimeExtensionInterface;

class MoneyExtensionRuntime implements RuntimeExtensionInterface
{

    /**
     * @param array<string, string> $attrs
     */
    public function formatMoney(Money $money, array $attrs = [], ?string $locale = null): string
    {
        $attrs = array_merge(['fraction_digit' => 2], $attrs);

        return sprintf(
            '%s %s',
            $money->getValue() / 100,
            $money->getCurrency()
        );
    }
}
