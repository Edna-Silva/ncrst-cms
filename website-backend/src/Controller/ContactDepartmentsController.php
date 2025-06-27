<?php

namespace App\Controller;

use App\Entity\ContactDepartments;
use App\Form\ContactDepartments1Type;
use App\Repository\ContactDepartmentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact/departments")
 */
class ContactDepartmentsController extends AbstractController
{
    /**
     * @Route("/", name="app_contact_departments_index", methods={"GET"})
     */
    public function index(ContactDepartmentsRepository $contactDepartmentsRepository): Response
    {
        return $this->render('contact_departments/index.html.twig', [
            'contact_departments' => $contactDepartmentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_contact_departments_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ContactDepartmentsRepository $contactDepartmentsRepository): Response
    {
        $contactDepartment = new ContactDepartments();
        $form = $this->createForm(ContactDepartments1Type::class, $contactDepartment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactDepartmentsRepository->add($contactDepartment, true);

            return $this->redirectToRoute('app_contact_departments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_departments/new.html.twig', [
            'contact_department' => $contactDepartment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_contact_departments_show", methods={"GET"})
     */
    public function show(ContactDepartments $contactDepartment): Response
    {
        return $this->render('contact_departments/show.html.twig', [
            'contact_department' => $contactDepartment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_contact_departments_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ContactDepartments $contactDepartment, ContactDepartmentsRepository $contactDepartmentsRepository): Response
    {
        $form = $this->createForm(ContactDepartments1Type::class, $contactDepartment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactDepartmentsRepository->add($contactDepartment, true);

            return $this->redirectToRoute('app_contact_departments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact_departments/edit.html.twig', [
            'contact_department' => $contactDepartment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_contact_departments_delete", methods={"POST"})
     */
    public function delete(Request $request, ContactDepartments $contactDepartment, ContactDepartmentsRepository $contactDepartmentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactDepartment->getId(), $request->request->get('_token'))) {
            $contactDepartmentsRepository->remove($contactDepartment, true);
        }

        return $this->redirectToRoute('app_contact_departments_index', [], Response::HTTP_SEE_OTHER);
    }
}
