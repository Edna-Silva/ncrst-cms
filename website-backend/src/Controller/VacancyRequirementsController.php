<?php

namespace App\Controller;

use App\Entity\VacancyRequirements;
use App\Form\VacancyRequirements1Type;
use App\Repository\VacancyRequirementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vacancy/requirements")
 */
class VacancyRequirementsController extends AbstractController
{
    /**
     * @Route("/", name="app_vacancy_requirements_index", methods={"GET"})
     */
    public function index(VacancyRequirementsRepository $vacancyRequirementsRepository): Response
    {
        return $this->render('vacancy_requirements/index.html.twig', [
            'vacancy_requirements' => $vacancyRequirementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_vacancy_requirements_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VacancyRequirementsRepository $vacancyRequirementsRepository): Response
    {
        $vacancyRequirement = new VacancyRequirements();
        $form = $this->createForm(VacancyRequirements1Type::class, $vacancyRequirement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacancyRequirementsRepository->add($vacancyRequirement, true);

            return $this->redirectToRoute('app_vacancy_requirements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vacancy_requirements/new.html.twig', [
            'vacancy_requirement' => $vacancyRequirement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_vacancy_requirements_show", methods={"GET"})
     */
    public function show(VacancyRequirements $vacancyRequirement): Response
    {
        return $this->render('vacancy_requirements/show.html.twig', [
            'vacancy_requirement' => $vacancyRequirement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_vacancy_requirements_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, VacancyRequirements $vacancyRequirement, VacancyRequirementsRepository $vacancyRequirementsRepository): Response
    {
        $form = $this->createForm(VacancyRequirements1Type::class, $vacancyRequirement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacancyRequirementsRepository->add($vacancyRequirement, true);

            return $this->redirectToRoute('app_vacancy_requirements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vacancy_requirements/edit.html.twig', [
            'vacancy_requirement' => $vacancyRequirement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_vacancy_requirements_delete", methods={"POST"})
     */
    public function delete(Request $request, VacancyRequirements $vacancyRequirement, VacancyRequirementsRepository $vacancyRequirementsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacancyRequirement->getId(), $request->request->get('_token'))) {
            $vacancyRequirementsRepository->remove($vacancyRequirement, true);
        }

        return $this->redirectToRoute('app_vacancy_requirements_index', [], Response::HTTP_SEE_OTHER);
    }
}
