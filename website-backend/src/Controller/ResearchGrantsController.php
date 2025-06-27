<?php

namespace App\Controller;

use App\Entity\ResearchGrants;
use App\Form\ResearchGrants1Type;
use App\Repository\ResearchGrantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/research/grants")
 */
class ResearchGrantsController extends AbstractController
{
    /**
     * @Route("/", name="app_research_grants_index", methods={"GET"})
     */
    public function index(ResearchGrantsRepository $researchGrantsRepository): Response
    {
        return $this->render('research_grants/index.html.twig', [
            'research_grants' => $researchGrantsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_research_grants_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ResearchGrantsRepository $researchGrantsRepository): Response
    {
        $researchGrant = new ResearchGrants();
        $form = $this->createForm(ResearchGrants1Type::class, $researchGrant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $researchGrantsRepository->add($researchGrant, true);

            return $this->redirectToRoute('app_research_grants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('research_grants/new.html.twig', [
            'research_grant' => $researchGrant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_research_grants_show", methods={"GET"})
     */
    public function show(ResearchGrants $researchGrant): Response
    {
        return $this->render('research_grants/show.html.twig', [
            'research_grant' => $researchGrant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_research_grants_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ResearchGrants $researchGrant, ResearchGrantsRepository $researchGrantsRepository): Response
    {
        $form = $this->createForm(ResearchGrants1Type::class, $researchGrant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $researchGrantsRepository->add($researchGrant, true);

            return $this->redirectToRoute('app_research_grants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('research_grants/edit.html.twig', [
            'research_grant' => $researchGrant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_research_grants_delete", methods={"POST"})
     */
    public function delete(Request $request, ResearchGrants $researchGrant, ResearchGrantsRepository $researchGrantsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$researchGrant->getId(), $request->request->get('_token'))) {
            $researchGrantsRepository->remove($researchGrant, true);
        }

        return $this->redirectToRoute('app_research_grants_index', [], Response::HTTP_SEE_OTHER);
    }
}
