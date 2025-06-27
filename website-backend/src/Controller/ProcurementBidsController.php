<?php

namespace App\Controller;

use App\Entity\ProcurementBids;
use App\Form\ProcurementBids1Type;
use App\Repository\ProcurementBidsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/procurement/bids")
 */
class ProcurementBidsController extends AbstractController
{
    /**
     * @Route("/", name="app_procurement_bids_index", methods={"GET"})
     */
    public function index(ProcurementBidsRepository $procurementBidsRepository): Response
    {
        return $this->render('procurement_bids/index.html.twig', [
            'procurement_bids' => $procurementBidsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_procurement_bids_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProcurementBidsRepository $procurementBidsRepository): Response
    {
        $procurementBid = new ProcurementBids();
        $form = $this->createForm(ProcurementBids1Type::class, $procurementBid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $procurementBidsRepository->add($procurementBid, true);

            return $this->redirectToRoute('app_procurement_bids_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('procurement_bids/new.html.twig', [
            'procurement_bid' => $procurementBid,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_procurement_bids_show", methods={"GET"})
     */
    public function show(ProcurementBids $procurementBid): Response
    {
        return $this->render('procurement_bids/show.html.twig', [
            'procurement_bid' => $procurementBid,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_procurement_bids_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProcurementBids $procurementBid, ProcurementBidsRepository $procurementBidsRepository): Response
    {
        $form = $this->createForm(ProcurementBids1Type::class, $procurementBid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $procurementBidsRepository->add($procurementBid, true);

            return $this->redirectToRoute('app_procurement_bids_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('procurement_bids/edit.html.twig', [
            'procurement_bid' => $procurementBid,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_procurement_bids_delete", methods={"POST"})
     */
    public function delete(Request $request, ProcurementBids $procurementBid, ProcurementBidsRepository $procurementBidsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$procurementBid->getId(), $request->request->get('_token'))) {
            $procurementBidsRepository->remove($procurementBid, true);
        }

        return $this->redirectToRoute('app_procurement_bids_index', [], Response::HTTP_SEE_OTHER);
    }
}
