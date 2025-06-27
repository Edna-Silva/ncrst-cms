<?php

namespace App\Controller;

use App\Entity\Uploads;
use App\Form\Uploads1Type;
use App\Repository\UploadsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/uploads")
 */
class UploadsController extends AbstractController
{
    /**
     * @Route("/", name="app_uploads_index", methods={"GET"})
     */
    public function index(UploadsRepository $uploadsRepository): Response
    {
        return $this->render('uploads/index.html.twig', [
            'uploads' => $uploadsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_uploads_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UploadsRepository $uploadsRepository): Response
    {
        $upload = new Uploads();
        $form = $this->createForm(Uploads1Type::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadsRepository->add($upload, true);

            return $this->redirectToRoute('app_uploads_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('uploads/new.html.twig', [
            'upload' => $upload,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_uploads_show", methods={"GET"})
     */
    public function show(Uploads $upload): Response
    {
        return $this->render('uploads/show.html.twig', [
            'upload' => $upload,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_uploads_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Uploads $upload, UploadsRepository $uploadsRepository): Response
    {
        $form = $this->createForm(Uploads1Type::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadsRepository->add($upload, true);

            return $this->redirectToRoute('app_uploads_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('uploads/edit.html.twig', [
            'upload' => $upload,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_uploads_delete", methods={"POST"})
     */
    public function delete(Request $request, Uploads $upload, UploadsRepository $uploadsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$upload->getId(), $request->request->get('_token'))) {
            $uploadsRepository->remove($upload, true);
        }

        return $this->redirectToRoute('app_uploads_index', [], Response::HTTP_SEE_OTHER);
    }
}
