<?php

namespace App\Controller;

use App\Entity\BoardCommissioners;
use App\Form\BoardCommissioners1Type;
use App\Repository\BoardCommissionersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/board/commissioners")
 */
class BoardCommissionersController extends AbstractController
{
    /**
     * @Route("/", name="app_board_commissioners_index", methods={"GET"})
     */
    public function index(BoardCommissionersRepository $boardCommissionersRepository): Response
    {
        return $this->render('board_commissioners/index.html.twig', [
            'board_commissioners' => $boardCommissionersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_board_commissioners_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BoardCommissionersRepository $boardCommissionersRepository): Response
    {
        $boardCommissioner = new BoardCommissioners();
        $form = $this->createForm(BoardCommissioners1Type::class, $boardCommissioner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $boardCommissionersRepository->add($boardCommissioner, true);

            return $this->redirectToRoute('app_board_commissioners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('board_commissioners/new.html.twig', [
            'board_commissioner' => $boardCommissioner,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_board_commissioners_show", methods={"GET"})
     */
    public function show(BoardCommissioners $boardCommissioner): Response
    {
        return $this->render('board_commissioners/show.html.twig', [
            'board_commissioner' => $boardCommissioner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_board_commissioners_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BoardCommissioners $boardCommissioner, BoardCommissionersRepository $boardCommissionersRepository): Response
    {
        $form = $this->createForm(BoardCommissioners1Type::class, $boardCommissioner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $boardCommissionersRepository->add($boardCommissioner, true);

            return $this->redirectToRoute('app_board_commissioners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('board_commissioners/edit.html.twig', [
            'board_commissioner' => $boardCommissioner,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_board_commissioners_delete", methods={"POST"})
     */
    public function delete(Request $request, BoardCommissioners $boardCommissioner, BoardCommissionersRepository $boardCommissionersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$boardCommissioner->getId(), $request->request->get('_token'))) {
            $boardCommissionersRepository->remove($boardCommissioner, true);
        }

        return $this->redirectToRoute('app_board_commissioners_index', [], Response::HTTP_SEE_OTHER);
    }
}
