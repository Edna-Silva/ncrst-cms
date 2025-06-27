<?php

namespace App\Controller;

use App\Entity\EcosystemPartners;
use App\Form\EcosystemPartners1Type;
use App\Repository\EcosystemPartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ecosystem/partners")
 */
class EcosystemPartnersController extends AbstractController
{
    /**
     * @Route("/", name="app_ecosystem_partners_index", methods={"GET"})
     */
    public function index(EcosystemPartnersRepository $ecosystemPartnersRepository): Response
    {
        return $this->render('ecosystem_partners/index.html.twig', [
            'ecosystem_partners' => $ecosystemPartnersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_ecosystem_partners_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EcosystemPartnersRepository $ecosystemPartnersRepository): Response
    {
        $ecosystemPartner = new EcosystemPartners();
        $form = $this->createForm(EcosystemPartners1Type::class, $ecosystemPartner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ecosystemPartnersRepository->add($ecosystemPartner, true);

            return $this->redirectToRoute('app_ecosystem_partners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ecosystem_partners/new.html.twig', [
            'ecosystem_partner' => $ecosystemPartner,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ecosystem_partners_show", methods={"GET"})
     */
    public function show(EcosystemPartners $ecosystemPartner): Response
    {
        return $this->render('ecosystem_partners/show.html.twig', [
            'ecosystem_partner' => $ecosystemPartner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ecosystem_partners_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EcosystemPartners $ecosystemPartner, EcosystemPartnersRepository $ecosystemPartnersRepository): Response
    {
        $form = $this->createForm(EcosystemPartners1Type::class, $ecosystemPartner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ecosystemPartnersRepository->add($ecosystemPartner, true);

            return $this->redirectToRoute('app_ecosystem_partners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ecosystem_partners/edit.html.twig', [
            'ecosystem_partner' => $ecosystemPartner,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ecosystem_partners_delete", methods={"POST"})
     */
    public function delete(Request $request, EcosystemPartners $ecosystemPartner, EcosystemPartnersRepository $ecosystemPartnersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ecosystemPartner->getId(), $request->request->get('_token'))) {
            $ecosystemPartnersRepository->remove($ecosystemPartner, true);
        }

        return $this->redirectToRoute('app_ecosystem_partners_index', [], Response::HTTP_SEE_OTHER);
    }
}
