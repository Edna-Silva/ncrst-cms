<?php

namespace App\Controller;

use App\Entity\IksIniatives;
use App\Form\IksIniativesType;
use App\Repository\IksIniativesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iks/iniatives")
 */
class IksIniativesController extends AbstractController
{
    /**
     * @Route("/", name="app_iks_iniatives_index", methods={"GET"})
     */
    public function index(IksIniativesRepository $iksIniativesRepository): Response
    {
        return $this->render('iks_iniatives/index.html.twig', [
            'iks_iniatives' => $iksIniativesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iks_iniatives_new", methods={"GET", "POST"})
     */
    public function new(Request $request, IksIniativesRepository $iksIniativesRepository): Response
    {
        $iksIniative = new IksIniatives();
        $form = $this->createForm(IksIniativesType::class, $iksIniative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksIniativesRepository->add($iksIniative, true);

            return $this->redirectToRoute('app_iks_iniatives_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_iniatives/new.html.twig', [
            'iks_iniative' => $iksIniative,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_iniatives_show", methods={"GET"})
     */
    public function show(IksIniatives $iksIniative): Response
    {
        return $this->render('iks_iniatives/show.html.twig', [
            'iks_iniative' => $iksIniative,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iks_iniatives_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, IksIniatives $iksIniative, IksIniativesRepository $iksIniativesRepository): Response
    {
        $form = $this->createForm(IksIniativesType::class, $iksIniative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksIniativesRepository->add($iksIniative, true);

            return $this->redirectToRoute('app_iks_iniatives_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_iniatives/edit.html.twig', [
            'iks_iniative' => $iksIniative,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_iniatives_delete", methods={"POST"})
     */
    public function delete(Request $request, IksIniatives $iksIniative, IksIniativesRepository $iksIniativesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$iksIniative->getId(), $request->request->get('_token'))) {
            $iksIniativesRepository->remove($iksIniative, true);
        }

        return $this->redirectToRoute('app_iks_iniatives_index', [], Response::HTTP_SEE_OTHER);
    }
}
