<?php

declare(strict_types=1);

namespace App\Application\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class Controller extends AbstractController
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    #[Route('/api/products', name: 'get_orders', methods: ['GET'])]
    public function asd(): JsonResponse
    {
        return $this->successData([
            'products' => [
                [
                    'name' => 'Kubek',
                    'brand' => 'Kubek z logo firmy, pojemność 300ml.',
                    'price' => '12',
                    'image' => 'asd',
                ],
                [
                    'name' => 'Koszulka',
                    'brand' => 'Koszulka z nadrukiem, rozmiar M, kolor czarny.',
                    'price' => '12',
                    'image' => 'asd',
                ],
                [
                    'name' => 'Ołówek',
                    'brand' => 'Ołówek drewniany, miękki, HB.',
                    'price' => '12',
                    'image' => 'asd',

                ],
                [
                    'name' => 'Notes',
                    'brand' => 'Notes w linie, A5, 100 kartek, kolor niebieski.',
                    'price' => '12',
                    'image' => 'asd',

                ],
                [
                    'name' => 'Długopis',
                    'brand' => 'Długopis z kulką, czarny, atrament nieścieralny.',
                    'price' => '12',
                    'image' => 'asd',

                ]
            ],
        ]);
    }

    #[Route('/api/categories', name: 'get_categories', methods: ['GET'])]
    public function categories(): JsonResponse
    {
        return $this->successData([
            'categories' => [
                [
                    'name' => 'Kategoria1',
                    'link' => '1'
                ],
                [
                    'name' => 'Kategoria12',
                    'link' => '12'
                ],
                [
                    'name' => 'Kategoria13',
                    'link' => '13'
                ],
                [
                    'name' => 'Kategoria14',
                    'link' => '14'
                ],
                [
                    'name' => 'Kategoria15',
                    'link' => '15'
                ]
            ],
        ]);
    }

    protected function successData(mixed $data, int $response = Response::HTTP_OK): JsonResponse
    {
        return $this->json2([
            'response' => true,
            'data' => $data,
        ], $response);
    }

    private function json2(mixed $data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        $json = $this->serializer->serialize($data, 'json', array_merge([
            'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
        ], $context));

        return new JsonResponse($json, $status, $headers, true);
    }
}
