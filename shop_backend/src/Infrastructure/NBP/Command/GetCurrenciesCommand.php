<?php

declare(strict_types=1);

namespace App\Infrastructure\NBP\Command;

use App\Application\Currency\Service\CurrencyManager;
use App\Infrastructure\NBP\Client;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Cron running every hour
 */
#[AsCommand(name: 'app:nbp:get_currencies')]
class GetCurrenciesCommand extends Command
{
    public function __construct(
        private readonly Client $client,
        private readonly CurrencyManager $currencyManager,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $currencies = $this->client->getCurrencies();

        if (!$currencies) {
            $output->writeln('Failed to download currencies');

            return Command::FAILURE;
        }


        foreach ($currencies->rates as $currency) {
            $this->currencyManager->processEntityData($currency);
        }

        return Command::SUCCESS;
    }
}
