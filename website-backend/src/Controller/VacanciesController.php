<?php

namespace App\Controller;

use App\Entity\Vacancies;
use App\Form\Vacancies1Type;
use App\Repository\VacanciesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vacancies")
 */
class VacanciesController extends AbstractController
{
    /**
     * @Route("/", name="app_vacancies_index", methods={"GET"})
     */
    public function index(VacanciesRepository $vacanciesRepository): Response
    {
        return $this->render('vacancies/index.html.twig', [
            'vacancies' => $vacanciesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_vacancies_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VacanciesRepository $vacanciesRepository): Response
    {
        $vacancy = new Vacancies();
        $form = $this->createForm(Vacancies1Type::class, $vacancy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacanciesRepository->add($vacancy, true);

            return $this->redirectToRoute('app_vacancies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vacancies/new.html.twig', [
            'vacancy' => $vacancy,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_vacancies_show", methods={"GET"})
     */
    public function show(Vacancies $vacancy): Response
    {
        return $this->render('vacancies/show.html.twig', [
            'vacancy' => $vacancy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_vacancies_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Vacancies $vacancy, VacanciesRepository $vacanciesRepository): Response
    {
        $form = $this->createForm(Vacancies1Type::class, $vacancy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacanciesRepository->add($vacancy, true);

            return $this->redirectToRoute('app_vacancies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vacancies/edit.html.twig', [
            'vacancy' => $vacancy,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_vacancies_delete", methods={"POST"})
     */
    public function delete(Request $request, Vacancies $vacancy, VacanciesRepository $vacanciesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacancy->getId(), $request->request->get('_token'))) {
            $vacanciesRepository->remove($vacancy, true);
        }

        return $this->redirectToRoute('app_vacancies_index', [], Response::HTTP_SEE_OTHER);
    }
}
