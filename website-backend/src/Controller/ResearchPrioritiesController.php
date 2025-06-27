<?php

namespace App\Controller;

use App\Entity\ResearchPriorities;
use App\Form\ResearchPriorities1Type;
use App\Repository\ResearchPrioritiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/research/priorities")
 */
class ResearchPrioritiesController extends AbstractController
{
    /**
     * @Route("/", name="app_research_priorities_index", methods={"GET"})
     */
    public function index(ResearchPrioritiesRepository $researchPrioritiesRepository): Response
    {
        return $this->render('research_priorities/index.html.twig', [
            'research_priorities' => $researchPrioritiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_research_priorities_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ResearchPrioritiesRepository $researchPrioritiesRepository): Response
    {
        $researchPriority = new ResearchPriorities();
        $form = $this->createForm(ResearchPriorities1Type::class, $researchPriority);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $researchPrioritiesRepository->add($researchPriority, true);

            return $this->redirectToRoute('app_research_priorities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('research_priorities/new.html.twig', [
            'research_priority' => $researchPriority,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_research_priorities_show", methods={"GET"})
     */
    public function show(ResearchPriorities $researchPriority): Response
    {
        return $this->render('research_priorities/show.html.twig', [
            'research_priority' => $researchPriority,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_research_priorities_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ResearchPriorities $researchPriority, ResearchPrioritiesRepository $researchPrioritiesRepository): Response
    {
        $form = $this->createForm(ResearchPriorities1Type::class, $researchPriority);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $researchPrioritiesRepository->add($researchPriority, true);

            return $this->redirectToRoute('app_research_priorities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('research_priorities/edit.html.twig', [
            'research_priority' => $researchPriority,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_research_priorities_delete", methods={"POST"})
     */
    public function delete(Request $request, ResearchPriorities $researchPriority, ResearchPrioritiesRepository $researchPrioritiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$researchPriority->getId(), $request->request->get('_token'))) {
            $researchPrioritiesRepository->remove($researchPriority, true);
        }

        return $this->redirectToRoute('app_research_priorities_index', [], Response::HTTP_SEE_OTHER);
    }
}
