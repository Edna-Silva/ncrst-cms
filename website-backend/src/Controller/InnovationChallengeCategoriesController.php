<?php

namespace App\Controller;

use App\Entity\InnovationChallengeCategories;
use App\Form\InnovationChallengeCategories1Type;
use App\Repository\InnovationChallengeCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/innovation/challenge/categories")
 */
class InnovationChallengeCategoriesController extends AbstractController
{
    /**
     * @Route("/", name="app_innovation_challenge_categories_index", methods={"GET"})
     */
    public function index(InnovationChallengeCategoriesRepository $innovationChallengeCategoriesRepository): Response
    {
        return $this->render('innovation_challenge_categories/index.html.twig', [
            'innovation_challenge_categories' => $innovationChallengeCategoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_innovation_challenge_categories_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InnovationChallengeCategoriesRepository $innovationChallengeCategoriesRepository): Response
    {
        $innovationChallengeCategory = new InnovationChallengeCategories();
        $form = $this->createForm(InnovationChallengeCategories1Type::class, $innovationChallengeCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $innovationChallengeCategoriesRepository->add($innovationChallengeCategory, true);

            return $this->redirectToRoute('app_innovation_challenge_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('innovation_challenge_categories/new.html.twig', [
            'innovation_challenge_category' => $innovationChallengeCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_innovation_challenge_categories_show", methods={"GET"})
     */
    public function show(InnovationChallengeCategories $innovationChallengeCategory): Response
    {
        return $this->render('innovation_challenge_categories/show.html.twig', [
            'innovation_challenge_category' => $innovationChallengeCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_innovation_challenge_categories_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InnovationChallengeCategories $innovationChallengeCategory, InnovationChallengeCategoriesRepository $innovationChallengeCategoriesRepository): Response
    {
        $form = $this->createForm(InnovationChallengeCategories1Type::class, $innovationChallengeCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $innovationChallengeCategoriesRepository->add($innovationChallengeCategory, true);

            return $this->redirectToRoute('app_innovation_challenge_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('innovation_challenge_categories/edit.html.twig', [
            'innovation_challenge_category' => $innovationChallengeCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_innovation_challenge_categories_delete", methods={"POST"})
     */
    public function delete(Request $request, InnovationChallengeCategories $innovationChallengeCategory, InnovationChallengeCategoriesRepository $innovationChallengeCategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$innovationChallengeCategory->getId(), $request->request->get('_token'))) {
            $innovationChallengeCategoriesRepository->remove($innovationChallengeCategory, true);
        }

        return $this->redirectToRoute('app_innovation_challenge_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
