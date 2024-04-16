<?php

declare(strict_types=1);

namespace App\Application\Currency\Service;

use App\Application\Currency\Handler\Create;
use App\Application\Currency\Handler\Update;
use App\Application\Currency\Provider\CurrencyProvider;
use App\Infrastructure\NBP\DTO\RatesDTO;

class CurrencyManager
{
    public function __construct(
        private readonly Create $create,
        private readonly Update $update,
        private readonly CurrencyProvider $currencyProvider,
    ) {
    }

    public function processEntityData(RatesDTO $dto): void
    {
        try {
            $currency = $this->currencyProvider->loadByCode($dto->code);
        } catch (\InvalidArgumentException) {
            $this->create->create($dto);

            return;
        }

        $this->update->update($currency, $dto);
    }
}
