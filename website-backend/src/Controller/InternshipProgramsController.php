<?php

namespace App\Controller;

use App\Entity\InternshipPrograms;
use App\Form\InternshipPrograms1Type;
use App\Repository\InternshipProgramsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/internship/programs")
 */
class InternshipProgramsController extends AbstractController
{
    /**
     * @Route("/", name="app_internship_programs_index", methods={"GET"})
     */
    public function index(InternshipProgramsRepository $internshipProgramsRepository): Response
    {
        return $this->render('internship_programs/index.html.twig', [
            'internship_programs' => $internshipProgramsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_internship_programs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InternshipProgramsRepository $internshipProgramsRepository): Response
    {
        $internshipProgram = new InternshipPrograms();
        $form = $this->createForm(InternshipPrograms1Type::class, $internshipProgram);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $internshipProgramsRepository->add($internshipProgram, true);

            return $this->redirectToRoute('app_internship_programs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('internship_programs/new.html.twig', [
            'internship_program' => $internshipProgram,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_internship_programs_show", methods={"GET"})
     */
    public function show(InternshipPrograms $internshipProgram): Response
    {
        return $this->render('internship_programs/show.html.twig', [
            'internship_program' => $internshipProgram,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_internship_programs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InternshipPrograms $internshipProgram, InternshipProgramsRepository $internshipProgramsRepository): Response
    {
        $form = $this->createForm(InternshipPrograms1Type::class, $internshipProgram);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $internshipProgramsRepository->add($internshipProgram, true);

            return $this->redirectToRoute('app_internship_programs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('internship_programs/edit.html.twig', [
            'internship_program' => $internshipProgram,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_internship_programs_delete", methods={"POST"})
     */
    public function delete(Request $request, InternshipPrograms $internshipProgram, InternshipProgramsRepository $internshipProgramsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$internshipProgram->getId(), $request->request->get('_token'))) {
            $internshipProgramsRepository->remove($internshipProgram, true);
        }

        return $this->redirectToRoute('app_internship_programs_index', [], Response::HTTP_SEE_OTHER);
    }
}
