<?php

namespace App\Controller;

use App\Entity\NewsArticles;
use App\Form\NewsArticles1Type;
use App\Repository\NewsArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news/articles")
 */
class NewsArticlesController extends AbstractController
{
    /**
     * @Route("/", name="app_news_articles_index", methods={"GET"})
     */
    public function index(NewsArticlesRepository $newsArticlesRepository): Response
    {
        return $this->render('news_articles/index.html.twig', [
            'news_articles' => $newsArticlesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_news_articles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, NewsArticlesRepository $newsArticlesRepository): Response
    {
        $newsArticle = new NewsArticles();
        $form = $this->createForm(NewsArticles1Type::class, $newsArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsArticlesRepository->add($newsArticle, true);

            return $this->redirectToRoute('app_news_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news_articles/new.html.twig', [
            'news_article' => $newsArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_news_articles_show", methods={"GET"})
     */
    public function show(NewsArticles $newsArticle): Response
    {
        return $this->render('news_articles/show.html.twig', [
            'news_article' => $newsArticle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_news_articles_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, NewsArticles $newsArticle, NewsArticlesRepository $newsArticlesRepository): Response
    {
        $form = $this->createForm(NewsArticles1Type::class, $newsArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsArticlesRepository->add($newsArticle, true);

            return $this->redirectToRoute('app_news_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news_articles/edit.html.twig', [
            'news_article' => $newsArticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_news_articles_delete", methods={"POST"})
     */
    public function delete(Request $request, NewsArticles $newsArticle, NewsArticlesRepository $newsArticlesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsArticle->getId(), $request->request->get('_token'))) {
            $newsArticlesRepository->remove($newsArticle, true);
        }

        return $this->redirectToRoute('app_news_articles_index', [], Response::HTTP_SEE_OTHER);
    }
}
