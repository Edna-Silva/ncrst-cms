<?php

namespace App\Controller;

use App\Entity\BoardCommissionerCommittees;
use App\Form\BoardCommissionerCommittees1Type;
use App\Repository\BoardCommissionerCommitteesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/board/commissioner/committees")
 */
class BoardCommissionerCommitteesController extends AbstractController
{
    /**
     * @Route("/", name="app_board_commissioner_committees_index", methods={"GET"})
     */
    public function index(BoardCommissionerCommitteesRepository $boardCommissionerCommitteesRepository): Response
    {
        return $this->render('board_commissioner_committees/index.html.twig', [
            'board_commissioner_committees' => $boardCommissionerCommitteesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_board_commissioner_committees_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BoardCommissionerCommitteesRepository $boardCommissionerCommitteesRepository): Response
    {
        $boardCommissionerCommittee = new BoardCommissionerCommittees();
        $form = $this->createForm(BoardCommissionerCommittees1Type::class, $boardCommissionerCommittee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $boardCommissionerCommitteesRepository->add($boardCommissionerCommittee, true);

            return $this->redirectToRoute('app_board_commissioner_committees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('board_commissioner_committees/new.html.twig', [
            'board_commissioner_committee' => $boardCommissionerCommittee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_board_commissioner_committees_show", methods={"GET"})
     */
    public function show(BoardCommissionerCommittees $boardCommissionerCommittee): Response
    {
        return $this->render('board_commissioner_committees/show.html.twig', [
            'board_commissioner_committee' => $boardCommissionerCommittee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_board_commissioner_committees_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BoardCommissionerCommittees $boardCommissionerCommittee, BoardCommissionerCommitteesRepository $boardCommissionerCommitteesRepository): Response
    {
        $form = $this->createForm(BoardCommissionerCommittees1Type::class, $boardCommissionerCommittee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $boardCommissionerCommitteesRepository->add($boardCommissionerCommittee, true);

            return $this->redirectToRoute('app_board_commissioner_committees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('board_commissioner_committees/edit.html.twig', [
            'board_commissioner_committee' => $boardCommissionerCommittee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_board_commissioner_committees_delete", methods={"POST"})
     */
    public function delete(Request $request, BoardCommissionerCommittees $boardCommissionerCommittee, BoardCommissionerCommitteesRepository $boardCommissionerCommitteesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$boardCommissionerCommittee->getId(), $request->request->get('_token'))) {
            $boardCommissionerCommitteesRepository->remove($boardCommissionerCommittee, true);
        }

        return $this->redirectToRoute('app_board_commissioner_committees_index', [], Response::HTTP_SEE_OTHER);
    }
}
