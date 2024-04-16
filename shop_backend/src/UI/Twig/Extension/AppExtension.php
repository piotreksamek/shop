<?php

declare(strict_types=1);

namespace App\UI\Twig\Extension;

use App\UI\Twig\RuntimeExtension\MoneyExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('format_money', [MoneyExtensionRuntime::class, 'formatMoney']),
        ];
    }
}
