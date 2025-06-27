<?php

namespace App\Controller;

use App\Entity\IksKnowledgeAreaExamples;
use App\Form\IksKnowledgeAreaExamples1Type;
use App\Repository\IksKnowledgeAreaExamplesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iks/knowledge/area/examples")
 */
class IksKnowledgeAreaExamplesController extends AbstractController
{
    /**
     * @Route("/", name="app_iks_knowledge_area_examples_index", methods={"GET"})
     */
    public function index(IksKnowledgeAreaExamplesRepository $iksKnowledgeAreaExamplesRepository): Response
    {
        return $this->render('iks_knowledge_area_examples/index.html.twig', [
            'iks_knowledge_area_examples' => $iksKnowledgeAreaExamplesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iks_knowledge_area_examples_new", methods={"GET", "POST"})
     */
    public function new(Request $request, IksKnowledgeAreaExamplesRepository $iksKnowledgeAreaExamplesRepository): Response
    {
        $iksKnowledgeAreaExample = new IksKnowledgeAreaExamples();
        $form = $this->createForm(IksKnowledgeAreaExamples1Type::class, $iksKnowledgeAreaExample);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksKnowledgeAreaExamplesRepository->add($iksKnowledgeAreaExample, true);

            return $this->redirectToRoute('app_iks_knowledge_area_examples_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_knowledge_area_examples/new.html.twig', [
            'iks_knowledge_area_example' => $iksKnowledgeAreaExample,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_knowledge_area_examples_show", methods={"GET"})
     */
    public function show(IksKnowledgeAreaExamples $iksKnowledgeAreaExample): Response
    {
        return $this->render('iks_knowledge_area_examples/show.html.twig', [
            'iks_knowledge_area_example' => $iksKnowledgeAreaExample,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iks_knowledge_area_examples_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, IksKnowledgeAreaExamples $iksKnowledgeAreaExample, IksKnowledgeAreaExamplesRepository $iksKnowledgeAreaExamplesRepository): Response
    {
        $form = $this->createForm(IksKnowledgeAreaExamples1Type::class, $iksKnowledgeAreaExample);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksKnowledgeAreaExamplesRepository->add($iksKnowledgeAreaExample, true);

            return $this->redirectToRoute('app_iks_knowledge_area_examples_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_knowledge_area_examples/edit.html.twig', [
            'iks_knowledge_area_example' => $iksKnowledgeAreaExample,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_knowledge_area_examples_delete", methods={"POST"})
     */
    public function delete(Request $request, IksKnowledgeAreaExamples $iksKnowledgeAreaExample, IksKnowledgeAreaExamplesRepository $iksKnowledgeAreaExamplesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$iksKnowledgeAreaExample->getId(), $request->request->get('_token'))) {
            $iksKnowledgeAreaExamplesRepository->remove($iksKnowledgeAreaExample, true);
        }

        return $this->redirectToRoute('app_iks_knowledge_area_examples_index', [], Response::HTTP_SEE_OTHER);
    }
}
