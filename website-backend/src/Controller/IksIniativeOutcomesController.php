<?php

namespace App\Controller;

use App\Entity\IksIniativeOutcomes;
use App\Form\IksIniativeOutcomesType;
use App\Repository\IksIniativeOutcomesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iks/iniative/outcomes")
 */
class IksIniativeOutcomesController extends AbstractController
{
    /**
     * @Route("/", name="app_iks_iniative_outcomes_index", methods={"GET"})
     */
    public function index(IksIniativeOutcomesRepository $iksIniativeOutcomesRepository): Response
    {
        return $this->render('iks_iniative_outcomes/index.html.twig', [
            'iks_iniative_outcomes' => $iksIniativeOutcomesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iks_iniative_outcomes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, IksIniativeOutcomesRepository $iksIniativeOutcomesRepository): Response
    {
        $iksIniativeOutcome = new IksIniativeOutcomes();
        $form = $this->createForm(IksIniativeOutcomesType::class, $iksIniativeOutcome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksIniativeOutcomesRepository->add($iksIniativeOutcome, true);

            return $this->redirectToRoute('app_iks_iniative_outcomes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_iniative_outcomes/new.html.twig', [
            'iks_iniative_outcome' => $iksIniativeOutcome,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_iniative_outcomes_show", methods={"GET"})
     */
    public function show(IksIniativeOutcomes $iksIniativeOutcome): Response
    {
        return $this->render('iks_iniative_outcomes/show.html.twig', [
            'iks_iniative_outcome' => $iksIniativeOutcome,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iks_iniative_outcomes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, IksIniativeOutcomes $iksIniativeOutcome, IksIniativeOutcomesRepository $iksIniativeOutcomesRepository): Response
    {
        $form = $this->createForm(IksIniativeOutcomesType::class, $iksIniativeOutcome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksIniativeOutcomesRepository->add($iksIniativeOutcome, true);

            return $this->redirectToRoute('app_iks_iniative_outcomes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_iniative_outcomes/edit.html.twig', [
            'iks_iniative_outcome' => $iksIniativeOutcome,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_iniative_outcomes_delete", methods={"POST"})
     */
    public function delete(Request $request, IksIniativeOutcomes $iksIniativeOutcome, IksIniativeOutcomesRepository $iksIniativeOutcomesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$iksIniativeOutcome->getId(), $request->request->get('_token'))) {
            $iksIniativeOutcomesRepository->remove($iksIniativeOutcome, true);
        }

        return $this->redirectToRoute('app_iks_iniative_outcomes_index', [], Response::HTTP_SEE_OTHER);
    }
}
