<?php

namespace App\Controller;

use App\Entity\InternshipDepartments;
use App\Form\InternshipDepartmentsType;
use App\Repository\InternshipDepartmentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/internship/departments")
 */
class InternshipDepartmentsController extends AbstractController
{
    /**
     * @Route("/", name="app_internship_departments_index", methods={"GET"})
     */
    public function index(InternshipDepartmentsRepository $internshipDepartmentsRepository): Response
    {
        return $this->render('internship_departments/index.html.twig', [
            'internship_departments' => $internshipDepartmentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_internship_departments_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InternshipDepartmentsRepository $internshipDepartmentsRepository): Response
    {
        $internshipDepartment = new InternshipDepartments();
        $form = $this->createForm(InternshipDepartmentsType::class, $internshipDepartment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $internshipDepartmentsRepository->add($internshipDepartment, true);

            return $this->redirectToRoute('app_internship_departments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('internship_departments/new.html.twig', [
            'internship_department' => $internshipDepartment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_internship_departments_show", methods={"GET"})
     */
    public function show(InternshipDepartments $internshipDepartment): Response
    {
        return $this->render('internship_departments/show.html.twig', [
            'internship_department' => $internshipDepartment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_internship_departments_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InternshipDepartments $internshipDepartment, InternshipDepartmentsRepository $internshipDepartmentsRepository): Response
    {
        $form = $this->createForm(InternshipDepartmentsType::class, $internshipDepartment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $internshipDepartmentsRepository->add($internshipDepartment, true);

            return $this->redirectToRoute('app_internship_departments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('internship_departments/edit.html.twig', [
            'internship_department' => $internshipDepartment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_internship_departments_delete", methods={"POST"})
     */
    public function delete(Request $request, InternshipDepartments $internshipDepartment, InternshipDepartmentsRepository $internshipDepartmentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$internshipDepartment->getId(), $request->request->get('_token'))) {
            $internshipDepartmentsRepository->remove($internshipDepartment, true);
        }

        return $this->redirectToRoute('app_internship_departments_index', [], Response::HTTP_SEE_OTHER);
    }
}
