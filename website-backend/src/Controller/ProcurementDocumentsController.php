<?php

namespace App\Controller;

use App\Entity\ProcurementDocuments;
use App\Form\ProcurementDocuments1Type;
use App\Repository\ProcurementDocumentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/procurement/documents")
 */
class ProcurementDocumentsController extends AbstractController
{
    /**
     * @Route("/", name="app_procurement_documents_index", methods={"GET"})
     */
    public function index(ProcurementDocumentsRepository $procurementDocumentsRepository): Response
    {
        return $this->render('procurement_documents/index.html.twig', [
            'procurement_documents' => $procurementDocumentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_procurement_documents_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProcurementDocumentsRepository $procurementDocumentsRepository): Response
    {
        $procurementDocument = new ProcurementDocuments();
        $form = $this->createForm(ProcurementDocuments1Type::class, $procurementDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $procurementDocumentsRepository->add($procurementDocument, true);

            return $this->redirectToRoute('app_procurement_documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('procurement_documents/new.html.twig', [
            'procurement_document' => $procurementDocument,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_procurement_documents_show", methods={"GET"})
     */
    public function show(ProcurementDocuments $procurementDocument): Response
    {
        return $this->render('procurement_documents/show.html.twig', [
            'procurement_document' => $procurementDocument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_procurement_documents_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProcurementDocuments $procurementDocument, ProcurementDocumentsRepository $procurementDocumentsRepository): Response
    {
        $form = $this->createForm(ProcurementDocuments1Type::class, $procurementDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $procurementDocumentsRepository->add($procurementDocument, true);

            return $this->redirectToRoute('app_procurement_documents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('procurement_documents/edit.html.twig', [
            'procurement_document' => $procurementDocument,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_procurement_documents_delete", methods={"POST"})
     */
    public function delete(Request $request, ProcurementDocuments $procurementDocument, ProcurementDocumentsRepository $procurementDocumentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$procurementDocument->getId(), $request->request->get('_token'))) {
            $procurementDocumentsRepository->remove($procurementDocument, true);
        }

        return $this->redirectToRoute('app_procurement_documents_index', [], Response::HTTP_SEE_OTHER);
    }
}
