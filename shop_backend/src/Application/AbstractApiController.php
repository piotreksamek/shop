<?php

declare(strict_types=1);

namespace App\Application;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractApiController
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    protected function successData(mixed $data, int $response = Response::HTTP_OK): JsonResponse
    {
        return $this->json([
            'response' => true,
            'data' => $data,
        ], $response);
    }

    private function json(mixed $data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        $json = $this->serializer->serialize($data, 'json', array_merge([
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ], $context));

        return new JsonResponse($json, $status, $headers, true);
    }
}
