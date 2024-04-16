<?php

declare(strict_types=1);

namespace App\Infrastructure\NBP;

use App\Infrastructure\NBP\Exception\ClientException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClient
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $url,
    ) {
    }

    public function sendRequest(): string
    {
        try {
            $response = $this->httpClient->request(Request::METHOD_GET, $this->url);
        } catch (\Exception $exception) {
            throw new ClientException($exception->getMessage());
        }

        return $response->getContent();
    }
}
