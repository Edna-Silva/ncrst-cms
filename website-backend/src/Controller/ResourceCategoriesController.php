<?php

namespace App\Controller;

use App\Entity\ResourceCategories;
use App\Form\ResourceCategories1Type;
use App\Repository\ResourceCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/resource/categories")
 */
class ResourceCategoriesController extends AbstractController
{
    /**
     * @Route("/", name="app_resource_categories_index", methods={"GET"})
     */
    public function index(ResourceCategoriesRepository $resourceCategoriesRepository): Response
    {
        return $this->render('resource_categories/index.html.twig', [
            'resource_categories' => $resourceCategoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_resource_categories_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ResourceCategoriesRepository $resourceCategoriesRepository): Response
    {
        $resourceCategory = new ResourceCategories();
        $form = $this->createForm(ResourceCategories1Type::class, $resourceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resourceCategoriesRepository->add($resourceCategory, true);

            return $this->redirectToRoute('app_resource_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resource_categories/new.html.twig', [
            'resource_category' => $resourceCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_resource_categories_show", methods={"GET"})
     */
    public function show(ResourceCategories $resourceCategory): Response
    {
        return $this->render('resource_categories/show.html.twig', [
            'resource_category' => $resourceCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_resource_categories_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ResourceCategories $resourceCategory, ResourceCategoriesRepository $resourceCategoriesRepository): Response
    {
        $form = $this->createForm(ResourceCategories1Type::class, $resourceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resourceCategoriesRepository->add($resourceCategory, true);

            return $this->redirectToRoute('app_resource_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resource_categories/edit.html.twig', [
            'resource_category' => $resourceCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_resource_categories_delete", methods={"POST"})
     */
    public function delete(Request $request, ResourceCategories $resourceCategory, ResourceCategoriesRepository $resourceCategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resourceCategory->getId(), $request->request->get('_token'))) {
            $resourceCategoriesRepository->remove($resourceCategory, true);
        }

        return $this->redirectToRoute('app_resource_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
