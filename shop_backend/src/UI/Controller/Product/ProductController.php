<?php

declare(strict_types=1);

namespace App\UI\Controller\Product;

use App\Application\Product\DTO\ProductDTO;
use App\Application\Product\Handler\Create;
use App\Application\Product\Handler\Delete;
use App\Application\Product\Handler\Update;
use App\Application\Product\Provider\PaginatorProvider;
use App\Application\Product\Provider\ProductProvider;
use App\UI\Form\Product\ProductFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(name: 'app_product_')]
class ProductController extends AbstractController
{
    #[Route('/products/{page}', name: 'list', requirements: ['page' => '\d+'], methods: ['GET'])]
    public function list(PaginatorProvider $paginatorProvider, ?int $page = 1): Response
    {
        $products = $paginatorProvider->findByPage($page);

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, Create $create): Response
    {
        $dto = new ProductDTO();

        $form = $this->createForm(ProductFormType::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $create->create($dto);

            $this->addFlash('success', 'product.create.success');

            return $this->redirectToRoute('app_product_list');
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/product/{id}/update', name: 'update', methods: ['GET', 'POST'])]
    public function update(
        string $id,
        Request $request,
        Update $update,
        ProductProvider $productProvider
    ): Response {
        try {
            $product = $productProvider->loadById($id);
            $dto = ProductDTO::from($product);
        } catch (\InvalidArgumentException $exception) {
            $this->addFlash('warning', $exception->getMessage());

            return $this->redirectToRoute('app_product_list');
        }

        $form = $this->createForm(ProductFormType::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $update->update($product, $dto);

            $this->addFlash('success', 'product.update.success');

            $this->redirectToRoute('app_product_list');
        }

        return $this->render('product/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/product/{id}/delete', name: 'delete')]
    public function delete(
        string $id,
        Delete $delete,
        ProductProvider $productProvider
    ): Response {
        try {
            $product = $productProvider->loadById($id);

            $delete->delete($product);
        } catch (\InvalidArgumentException $exception) {
            $this->addFlash('warning', $exception->getMessage());

            return $this->redirectToRoute('app_product_list');
        }

        $this->addFlash('success', 'product.delete.success');

        return $this->redirectToRoute('app_product_list');
    }
}
