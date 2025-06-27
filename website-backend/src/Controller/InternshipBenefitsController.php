<?php

namespace App\Controller;

use App\Entity\InternshipBenefits;
use App\Form\InternshipBenefits1Type;
use App\Repository\InternshipBenefitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/internship/benefits")
 */
class InternshipBenefitsController extends AbstractController
{
    /**
     * @Route("/", name="app_internship_benefits_index", methods={"GET"})
     */
    public function index(InternshipBenefitsRepository $internshipBenefitsRepository): Response
    {
        return $this->render('internship_benefits/index.html.twig', [
            'internship_benefits' => $internshipBenefitsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_internship_benefits_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InternshipBenefitsRepository $internshipBenefitsRepository): Response
    {
        $internshipBenefit = new InternshipBenefits();
        $form = $this->createForm(InternshipBenefits1Type::class, $internshipBenefit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $internshipBenefitsRepository->add($internshipBenefit, true);

            return $this->redirectToRoute('app_internship_benefits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('internship_benefits/new.html.twig', [
            'internship_benefit' => $internshipBenefit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_internship_benefits_show", methods={"GET"})
     */
    public function show(InternshipBenefits $internshipBenefit): Response
    {
        return $this->render('internship_benefits/show.html.twig', [
            'internship_benefit' => $internshipBenefit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_internship_benefits_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InternshipBenefits $internshipBenefit, InternshipBenefitsRepository $internshipBenefitsRepository): Response
    {
        $form = $this->createForm(InternshipBenefits1Type::class, $internshipBenefit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $internshipBenefitsRepository->add($internshipBenefit, true);

            return $this->redirectToRoute('app_internship_benefits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('internship_benefits/edit.html.twig', [
            'internship_benefit' => $internshipBenefit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_internship_benefits_delete", methods={"POST"})
     */
    public function delete(Request $request, InternshipBenefits $internshipBenefit, InternshipBenefitsRepository $internshipBenefitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$internshipBenefit->getId(), $request->request->get('_token'))) {
            $internshipBenefitsRepository->remove($internshipBenefit, true);
        }

        return $this->redirectToRoute('app_internship_benefits_index', [], Response::HTTP_SEE_OTHER);
    }
}
