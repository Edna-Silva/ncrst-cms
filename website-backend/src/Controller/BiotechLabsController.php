<?php

namespace App\Controller;

use App\Entity\BiotechLabs;
use App\Form\BiotechLabs1Type;
use App\Repository\BiotechLabsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/biotech/labs")
 */
class BiotechLabsController extends AbstractController
{
    /**
     * @Route("/", name="app_biotech_labs_index", methods={"GET"})
     */
    public function index(BiotechLabsRepository $biotechLabsRepository): Response
    {
        return $this->render('biotech_labs/index.html.twig', [
            'biotech_labs' => $biotechLabsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_biotech_labs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BiotechLabsRepository $biotechLabsRepository): Response
    {
        $biotechLab = new BiotechLabs();
        $form = $this->createForm(BiotechLabs1Type::class, $biotechLab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $biotechLabsRepository->add($biotechLab, true);

            return $this->redirectToRoute('app_biotech_labs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('biotech_labs/new.html.twig', [
            'biotech_lab' => $biotechLab,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_biotech_labs_show", methods={"GET"})
     */
    public function show(BiotechLabs $biotechLab): Response
    {
        return $this->render('biotech_labs/show.html.twig', [
            'biotech_lab' => $biotechLab,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_biotech_labs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BiotechLabs $biotechLab, BiotechLabsRepository $biotechLabsRepository): Response
    {
        $form = $this->createForm(BiotechLabs1Type::class, $biotechLab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $biotechLabsRepository->add($biotechLab, true);

            return $this->redirectToRoute('app_biotech_labs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('biotech_labs/edit.html.twig', [
            'biotech_lab' => $biotechLab,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_biotech_labs_delete", methods={"POST"})
     */
    public function delete(Request $request, BiotechLabs $biotechLab, BiotechLabsRepository $biotechLabsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$biotechLab->getId(), $request->request->get('_token'))) {
            $biotechLabsRepository->remove($biotechLab, true);
        }

        return $this->redirectToRoute('app_biotech_labs_index', [], Response::HTTP_SEE_OTHER);
    }
}
