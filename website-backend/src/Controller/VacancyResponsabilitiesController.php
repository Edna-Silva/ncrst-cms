<?php

namespace App\Controller;

use App\Entity\VacancyResponsabilities;
use App\Form\VacancyResponsabilities1Type;
use App\Repository\VacancyResponsabilitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vacancy/responsabilities")
 */
class VacancyResponsabilitiesController extends AbstractController
{
    /**
     * @Route("/", name="app_vacancy_responsabilities_index", methods={"GET"})
     */
    public function index(VacancyResponsabilitiesRepository $vacancyResponsabilitiesRepository): Response
    {
        return $this->render('vacancy_responsabilities/index.html.twig', [
            'vacancy_responsabilities' => $vacancyResponsabilitiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_vacancy_responsabilities_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VacancyResponsabilitiesRepository $vacancyResponsabilitiesRepository): Response
    {
        $vacancyResponsability = new VacancyResponsabilities();
        $form = $this->createForm(VacancyResponsabilities1Type::class, $vacancyResponsability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacancyResponsabilitiesRepository->add($vacancyResponsability, true);

            return $this->redirectToRoute('app_vacancy_responsabilities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vacancy_responsabilities/new.html.twig', [
            'vacancy_responsability' => $vacancyResponsability,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_vacancy_responsabilities_show", methods={"GET"})
     */
    public function show(VacancyResponsabilities $vacancyResponsability): Response
    {
        return $this->render('vacancy_responsabilities/show.html.twig', [
            'vacancy_responsability' => $vacancyResponsability,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_vacancy_responsabilities_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, VacancyResponsabilities $vacancyResponsability, VacancyResponsabilitiesRepository $vacancyResponsabilitiesRepository): Response
    {
        $form = $this->createForm(VacancyResponsabilities1Type::class, $vacancyResponsability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacancyResponsabilitiesRepository->add($vacancyResponsability, true);

            return $this->redirectToRoute('app_vacancy_responsabilities_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vacancy_responsabilities/edit.html.twig', [
            'vacancy_responsability' => $vacancyResponsability,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_vacancy_responsabilities_delete", methods={"POST"})
     */
    public function delete(Request $request, VacancyResponsabilities $vacancyResponsability, VacancyResponsabilitiesRepository $vacancyResponsabilitiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacancyResponsability->getId(), $request->request->get('_token'))) {
            $vacancyResponsabilitiesRepository->remove($vacancyResponsability, true);
        }

        return $this->redirectToRoute('app_vacancy_responsabilities_index', [], Response::HTTP_SEE_OTHER);
    }
}
