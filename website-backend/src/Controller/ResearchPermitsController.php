<?php

namespace App\Controller;

use App\Entity\ResearchPermits;
use App\Form\ResearchPermits1Type;
use App\Repository\ResearchPermitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/research/permits")
 */
class ResearchPermitsController extends AbstractController
{
    /**
     * @Route("/", name="app_research_permits_index", methods={"GET"})
     */
    public function index(ResearchPermitsRepository $researchPermitsRepository): Response
    {
        return $this->render('research_permits/index.html.twig', [
            'research_permits' => $researchPermitsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_research_permits_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ResearchPermitsRepository $researchPermitsRepository): Response
    {
        $researchPermit = new ResearchPermits();
        $form = $this->createForm(ResearchPermits1Type::class, $researchPermit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $researchPermitsRepository->add($researchPermit, true);

            return $this->redirectToRoute('app_research_permits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('research_permits/new.html.twig', [
            'research_permit' => $researchPermit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_research_permits_show", methods={"GET"})
     */
    public function show(ResearchPermits $researchPermit): Response
    {
        return $this->render('research_permits/show.html.twig', [
            'research_permit' => $researchPermit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_research_permits_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ResearchPermits $researchPermit, ResearchPermitsRepository $researchPermitsRepository): Response
    {
        $form = $this->createForm(ResearchPermits1Type::class, $researchPermit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $researchPermitsRepository->add($researchPermit, true);

            return $this->redirectToRoute('app_research_permits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('research_permits/edit.html.twig', [
            'research_permit' => $researchPermit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_research_permits_delete", methods={"POST"})
     */
    public function delete(Request $request, ResearchPermits $researchPermit, ResearchPermitsRepository $researchPermitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$researchPermit->getId(), $request->request->get('_token'))) {
            $researchPermitsRepository->remove($researchPermit, true);
        }

        return $this->redirectToRoute('app_research_permits_index', [], Response::HTTP_SEE_OTHER);
    }
}
