<?php

namespace App\Controller;

use App\Entity\IksResources;
use App\Form\IksResources1Type;
use App\Repository\IksResourcesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iks/resources")
 */
class IksResourcesController extends AbstractController
{
    /**
     * @Route("/", name="app_iks_resources_index", methods={"GET"})
     */
    public function index(IksResourcesRepository $iksResourcesRepository): Response
    {
        return $this->render('iks_resources/index.html.twig', [
            'iks_resources' => $iksResourcesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iks_resources_new", methods={"GET", "POST"})
     */
    public function new(Request $request, IksResourcesRepository $iksResourcesRepository): Response
    {
        $iksResource = new IksResources();
        $form = $this->createForm(IksResources1Type::class, $iksResource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksResourcesRepository->add($iksResource, true);

            return $this->redirectToRoute('app_iks_resources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_resources/new.html.twig', [
            'iks_resource' => $iksResource,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_resources_show", methods={"GET"})
     */
    public function show(IksResources $iksResource): Response
    {
        return $this->render('iks_resources/show.html.twig', [
            'iks_resource' => $iksResource,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iks_resources_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, IksResources $iksResource, IksResourcesRepository $iksResourcesRepository): Response
    {
        $form = $this->createForm(IksResources1Type::class, $iksResource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksResourcesRepository->add($iksResource, true);

            return $this->redirectToRoute('app_iks_resources_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_resources/edit.html.twig', [
            'iks_resource' => $iksResource,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_resources_delete", methods={"POST"})
     */
    public function delete(Request $request, IksResources $iksResource, IksResourcesRepository $iksResourcesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$iksResource->getId(), $request->request->get('_token'))) {
            $iksResourcesRepository->remove($iksResource, true);
        }

        return $this->redirectToRoute('app_iks_resources_index', [], Response::HTTP_SEE_OTHER);
    }
}
