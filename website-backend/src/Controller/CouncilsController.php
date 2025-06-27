<?php

namespace App\Controller;

use App\Entity\Councils;
use App\Form\Councils1Type;
use App\Repository\CouncilsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/councils")
 */
class CouncilsController extends AbstractController
{
    /**
     * @Route("/", name="app_councils_index", methods={"GET"})
     */
    public function index(CouncilsRepository $councilsRepository): Response
    {
        return $this->render('councils/index.html.twig', [
            'councils' => $councilsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_councils_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CouncilsRepository $councilsRepository): Response
    {
        $council = new Councils();
        $form = $this->createForm(Councils1Type::class, $council);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $councilsRepository->add($council, true);

            return $this->redirectToRoute('app_councils_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('councils/new.html.twig', [
            'council' => $council,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_councils_show", methods={"GET"})
     */
    public function show(Councils $council): Response
    {
        return $this->render('councils/show.html.twig', [
            'council' => $council,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_councils_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Councils $council, CouncilsRepository $councilsRepository): Response
    {
        $form = $this->createForm(Councils1Type::class, $council);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $councilsRepository->add($council, true);

            return $this->redirectToRoute('app_councils_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('councils/edit.html.twig', [
            'council' => $council,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_councils_delete", methods={"POST"})
     */
    public function delete(Request $request, Councils $council, CouncilsRepository $councilsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$council->getId(), $request->request->get('_token'))) {
            $councilsRepository->remove($council, true);
        }

        return $this->redirectToRoute('app_councils_index', [], Response::HTTP_SEE_OTHER);
    }
}
