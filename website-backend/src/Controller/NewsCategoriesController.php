<?php

namespace App\Controller;

use App\Entity\NewsCategories;
use App\Form\NewsCategories1Type;
use App\Repository\NewsCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news/categories")
 */
class NewsCategoriesController extends AbstractController
{
    /**
     * @Route("/", name="app_news_categories_index", methods={"GET"})
     */
    public function index(NewsCategoriesRepository $newsCategoriesRepository): Response
    {
        return $this->render('news_categories/index.html.twig', [
            'news_categories' => $newsCategoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_news_categories_new", methods={"GET", "POST"})
     */
    public function new(Request $request, NewsCategoriesRepository $newsCategoriesRepository): Response
    {
        $newsCategory = new NewsCategories();
        $form = $this->createForm(NewsCategories1Type::class, $newsCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsCategoriesRepository->add($newsCategory, true);

            return $this->redirectToRoute('app_news_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news_categories/new.html.twig', [
            'news_category' => $newsCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_news_categories_show", methods={"GET"})
     */
    public function show(NewsCategories $newsCategory): Response
    {
        return $this->render('news_categories/show.html.twig', [
            'news_category' => $newsCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_news_categories_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, NewsCategories $newsCategory, NewsCategoriesRepository $newsCategoriesRepository): Response
    {
        $form = $this->createForm(NewsCategories1Type::class, $newsCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsCategoriesRepository->add($newsCategory, true);

            return $this->redirectToRoute('app_news_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news_categories/edit.html.twig', [
            'news_category' => $newsCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_news_categories_delete", methods={"POST"})
     */
    public function delete(Request $request, NewsCategories $newsCategory, NewsCategoriesRepository $newsCategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsCategory->getId(), $request->request->get('_token'))) {
            $newsCategoriesRepository->remove($newsCategory, true);
        }

        return $this->redirectToRoute('app_news_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
