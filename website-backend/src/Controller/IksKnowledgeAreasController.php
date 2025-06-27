<?php

namespace App\Controller;

use App\Entity\IksKnowledgeAreas;
use App\Form\IksKnowledgeAreas1Type;
use App\Repository\IksKnowledgeAreasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iks/knowledge/areas")
 */
class IksKnowledgeAreasController extends AbstractController
{
    /**
     * @Route("/", name="app_iks_knowledge_areas_index", methods={"GET"})
     */
    public function index(IksKnowledgeAreasRepository $iksKnowledgeAreasRepository): Response
    {
        return $this->render('iks_knowledge_areas/index.html.twig', [
            'iks_knowledge_areas' => $iksKnowledgeAreasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iks_knowledge_areas_new", methods={"GET", "POST"})
     */
    public function new(Request $request, IksKnowledgeAreasRepository $iksKnowledgeAreasRepository): Response
    {
        $iksKnowledgeArea = new IksKnowledgeAreas();
        $form = $this->createForm(IksKnowledgeAreas1Type::class, $iksKnowledgeArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksKnowledgeAreasRepository->add($iksKnowledgeArea, true);

            return $this->redirectToRoute('app_iks_knowledge_areas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_knowledge_areas/new.html.twig', [
            'iks_knowledge_area' => $iksKnowledgeArea,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_knowledge_areas_show", methods={"GET"})
     */
    public function show(IksKnowledgeAreas $iksKnowledgeArea): Response
    {
        return $this->render('iks_knowledge_areas/show.html.twig', [
            'iks_knowledge_area' => $iksKnowledgeArea,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iks_knowledge_areas_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, IksKnowledgeAreas $iksKnowledgeArea, IksKnowledgeAreasRepository $iksKnowledgeAreasRepository): Response
    {
        $form = $this->createForm(IksKnowledgeAreas1Type::class, $iksKnowledgeArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksKnowledgeAreasRepository->add($iksKnowledgeArea, true);

            return $this->redirectToRoute('app_iks_knowledge_areas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_knowledge_areas/edit.html.twig', [
            'iks_knowledge_area' => $iksKnowledgeArea,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_knowledge_areas_delete", methods={"POST"})
     */
    public function delete(Request $request, IksKnowledgeAreas $iksKnowledgeArea, IksKnowledgeAreasRepository $iksKnowledgeAreasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$iksKnowledgeArea->getId(), $request->request->get('_token'))) {
            $iksKnowledgeAreasRepository->remove($iksKnowledgeArea, true);
        }

        return $this->redirectToRoute('app_iks_knowledge_areas_index', [], Response::HTTP_SEE_OTHER);
    }
}
