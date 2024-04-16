<?php

declare(strict_types=1);

namespace App\UI\Controller\Category;

use App\Application\Category\DTO\CategoryDTO;
use App\Application\Category\Handler\Create;
use App\Application\Category\Handler\Delete;
use App\Application\Category\Handler\Update;
use App\Application\Category\Provider\CategoryProvider;
use App\Application\Category\Provider\PaginatorProvider;
use App\UI\Form\Category\CategoryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(name: 'app_category_')]
class CategoryController extends AbstractController
{
    #[Route('/category/{page}', name: 'list', requirements: ['page' => '\d+'], methods: ['GET'])]
    public function list(PaginatorProvider $paginatorProvider, ?int $page = 1): Response
    {
        $categories = $paginatorProvider->findByPage($page);

        return $this->render('category/list.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/category/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, Create $create): Response
    {
        $dto = new CategoryDTO();

        $form = $this->createForm(CategoryFormType::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $create->create($dto);

            $this->addFlash('success', 'category.create.success');

            return $this->redirectToRoute('app_category_list');
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{id}/update', name: 'update', methods: ['GET', 'POST'])]
    public function update(
        string $id,
        Request $request,
        Update $update,
        CategoryProvider $categoryProvider
    ): Response {
        try {
            $category = $categoryProvider->loadById($id);
            $dto = CategoryDTO::from($category);
        } catch (\InvalidArgumentException $exception) {
            $this->addFlash('warning', $exception->getMessage());

            return $this->redirectToRoute('app_product_list');
        }

        $form = $this->createForm(CategoryFormType::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $update->update($category, $dto);

            $this->addFlash('success', 'category.update.success');

            return $this->redirectToRoute('app_category_list');
        }

        return $this->render('category/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{id}/delete', name: 'delete')]
    public function delete(
        string $id,
        Delete $delete,
        CategoryProvider $categoryProvider
    ): Response {
        try {
            $category = $categoryProvider->loadById($id);

            $delete->delete($category);
        } catch (\InvalidArgumentException $exception) {
            $this->addFlash('warning', $exception->getMessage());

            return $this->redirectToRoute('app_category_list');
        }

        $this->addFlash('success', 'category.delete.success');

        return $this->redirectToRoute('app_product_list');
    }
}
