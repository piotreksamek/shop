<?php

declare(strict_types=1);

namespace App\Infrastructure\NBP;

use App\Infrastructure\NBP\DTO\CurrencyDTO;
use App\Infrastructure\NBP\Exception\ClientException;
use Monolog\Attribute\WithMonologChannel;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[WithMonologChannel('currency')]
class Client
{
    public function __construct(
        private readonly HttpClient $httpClient,
        private readonly SerializerInterface $serializer,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function getCurrencies(): ?CurrencyDTO
    {
        try{
            $response = $this->httpClient->sendRequest();
        } catch (ClientException $clientException) {
            $this->logger->error($clientException->getMessage());

            return null;
        }

        $response = substr($response, 1, -1);

        return $this->serializer->deserialize($response, CurrencyDTO::class, 'json');
    }
}
