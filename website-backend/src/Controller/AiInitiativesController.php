<?php

namespace App\Controller;

use App\Entity\AiInitiatives;
use App\Form\AiInitiatives1Type;
use App\Repository\AiInitiativesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ai/initiatives")
 */
class AiInitiativesController extends AbstractController
{
    /**
     * @Route("/", name="app_ai_initiatives_index", methods={"GET"})
     */
    public function index(AiInitiativesRepository $aiInitiativesRepository): Response
    {
        return $this->render('ai_initiatives/index.html.twig', [
            'ai_initiatives' => $aiInitiativesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_ai_initiatives_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AiInitiativesRepository $aiInitiativesRepository): Response
    {
        $aiInitiative = new AiInitiatives();
        $form = $this->createForm(AiInitiatives1Type::class, $aiInitiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aiInitiativesRepository->add($aiInitiative, true);

            return $this->redirectToRoute('app_ai_initiatives_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ai_initiatives/new.html.twig', [
            'ai_initiative' => $aiInitiative,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ai_initiatives_show", methods={"GET"})
     */
    public function show(AiInitiatives $aiInitiative): Response
    {
        return $this->render('ai_initiatives/show.html.twig', [
            'ai_initiative' => $aiInitiative,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ai_initiatives_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AiInitiatives $aiInitiative, AiInitiativesRepository $aiInitiativesRepository): Response
    {
        $form = $this->createForm(AiInitiatives1Type::class, $aiInitiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aiInitiativesRepository->add($aiInitiative, true);

            return $this->redirectToRoute('app_ai_initiatives_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ai_initiatives/edit.html.twig', [
            'ai_initiative' => $aiInitiative,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ai_initiatives_delete", methods={"POST"})
     */
    public function delete(Request $request, AiInitiatives $aiInitiative, AiInitiativesRepository $aiInitiativesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aiInitiative->getId(), $request->request->get('_token'))) {
            $aiInitiativesRepository->remove($aiInitiative, true);
        }

        return $this->redirectToRoute('app_ai_initiatives_index', [], Response::HTTP_SEE_OTHER);
    }
}
