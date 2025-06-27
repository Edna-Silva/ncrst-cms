<?php

namespace App\Controller;

use App\Entity\BiotechLabServices;
use App\Form\BiotechLabServices2Type;
use App\Repository\BiotechLabServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/biotech/lab/services")
 */
class BiotechLabServicesController extends AbstractController
{
    /**
     * @Route("/", name="app_biotech_lab_services_index", methods={"GET"})
     */
    public function index(BiotechLabServicesRepository $biotechLabServicesRepository): Response
    {
        return $this->render('biotech_lab_services/index.html.twig', [
            'biotech_lab_services' => $biotechLabServicesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_biotech_lab_services_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BiotechLabServicesRepository $biotechLabServicesRepository): Response
    {
        $biotechLabService = new BiotechLabServices();
        $form = $this->createForm(BiotechLabServices2Type::class, $biotechLabService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $biotechLabServicesRepository->add($biotechLabService, true);

            return $this->redirectToRoute('app_biotech_lab_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('biotech_lab_services/new.html.twig', [
            'biotech_lab_service' => $biotechLabService,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_biotech_lab_services_show", methods={"GET"})
     */
    public function show(BiotechLabServices $biotechLabService): Response
    {
        return $this->render('biotech_lab_services/show.html.twig', [
            'biotech_lab_service' => $biotechLabService,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_biotech_lab_services_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BiotechLabServices $biotechLabService, BiotechLabServicesRepository $biotechLabServicesRepository): Response
    {
        $form = $this->createForm(BiotechLabServices2Type::class, $biotechLabService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $biotechLabServicesRepository->add($biotechLabService, true);

            return $this->redirectToRoute('app_biotech_lab_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('biotech_lab_services/edit.html.twig', [
            'biotech_lab_service' => $biotechLabService,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_biotech_lab_services_delete", methods={"POST"})
     */
    public function delete(Request $request, BiotechLabServices $biotechLabService, BiotechLabServicesRepository $biotechLabServicesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$biotechLabService->getId(), $request->request->get('_token'))) {
            $biotechLabServicesRepository->remove($biotechLabService, true);
        }

        return $this->redirectToRoute('app_biotech_lab_services_index', [], Response::HTTP_SEE_OTHER);
    }
}
