<?php

namespace App\Controller;

use App\Entity\SciencePrograms;
use App\Form\SciencePrograms1Type;
use App\Repository\ScienceProgramsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/science/programs")
 */
class ScienceProgramsController extends AbstractController
{
    /**
     * @Route("/", name="app_science_programs_index", methods={"GET"})
     */
    public function index(ScienceProgramsRepository $scienceProgramsRepository): Response
    {
        return $this->render('science_programs/index.html.twig', [
            'science_programs' => $scienceProgramsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_science_programs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ScienceProgramsRepository $scienceProgramsRepository): Response
    {
        $scienceProgram = new SciencePrograms();
        $form = $this->createForm(SciencePrograms1Type::class, $scienceProgram);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scienceProgramsRepository->add($scienceProgram, true);

            return $this->redirectToRoute('app_science_programs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('science_programs/new.html.twig', [
            'science_program' => $scienceProgram,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_science_programs_show", methods={"GET"})
     */
    public function show(SciencePrograms $scienceProgram): Response
    {
        return $this->render('science_programs/show.html.twig', [
            'science_program' => $scienceProgram,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_science_programs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SciencePrograms $scienceProgram, ScienceProgramsRepository $scienceProgramsRepository): Response
    {
        $form = $this->createForm(SciencePrograms1Type::class, $scienceProgram);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scienceProgramsRepository->add($scienceProgram, true);

            return $this->redirectToRoute('app_science_programs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('science_programs/edit.html.twig', [
            'science_program' => $scienceProgram,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_science_programs_delete", methods={"POST"})
     */
    public function delete(Request $request, SciencePrograms $scienceProgram, ScienceProgramsRepository $scienceProgramsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scienceProgram->getId(), $request->request->get('_token'))) {
            $scienceProgramsRepository->remove($scienceProgram, true);
        }

        return $this->redirectToRoute('app_science_programs_index', [], Response::HTTP_SEE_OTHER);
    }
}
