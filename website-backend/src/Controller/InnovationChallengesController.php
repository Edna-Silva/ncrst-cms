<?php

namespace App\Controller;

use App\Entity\InnovationChallenges;
use App\Form\InnovationChallenges1Type;
use App\Repository\InnovationChallengesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/innovation/challenges")
 */
class InnovationChallengesController extends AbstractController
{
    /**
     * @Route("/", name="app_innovation_challenges_index", methods={"GET"})
     */
    public function index(InnovationChallengesRepository $innovationChallengesRepository): Response
    {
        return $this->render('innovation_challenges/index.html.twig', [
            'innovation_challenges' => $innovationChallengesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_innovation_challenges_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InnovationChallengesRepository $innovationChallengesRepository): Response
    {
        $innovationChallenge = new InnovationChallenges();
        $form = $this->createForm(InnovationChallenges1Type::class, $innovationChallenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $innovationChallengesRepository->add($innovationChallenge, true);

            return $this->redirectToRoute('app_innovation_challenges_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('innovation_challenges/new.html.twig', [
            'innovation_challenge' => $innovationChallenge,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_innovation_challenges_show", methods={"GET"})
     */
    public function show(InnovationChallenges $innovationChallenge): Response
    {
        return $this->render('innovation_challenges/show.html.twig', [
            'innovation_challenge' => $innovationChallenge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_innovation_challenges_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InnovationChallenges $innovationChallenge, InnovationChallengesRepository $innovationChallengesRepository): Response
    {
        $form = $this->createForm(InnovationChallenges1Type::class, $innovationChallenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $innovationChallengesRepository->add($innovationChallenge, true);

            return $this->redirectToRoute('app_innovation_challenges_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('innovation_challenges/edit.html.twig', [
            'innovation_challenge' => $innovationChallenge,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_innovation_challenges_delete", methods={"POST"})
     */
    public function delete(Request $request, InnovationChallenges $innovationChallenge, InnovationChallengesRepository $innovationChallengesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$innovationChallenge->getId(), $request->request->get('_token'))) {
            $innovationChallengesRepository->remove($innovationChallenge, true);
        }

        return $this->redirectToRoute('app_innovation_challenges_index', [], Response::HTTP_SEE_OTHER);
    }
}
