<?php

namespace App\Controller;

use App\Entity\Innovators;
use App\Form\Innovators1Type;
use App\Repository\InnovatorsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/innovators")
 */
class InnovatorsController extends AbstractController
{
    /**
     * @Route("/", name="app_innovators_index", methods={"GET"})
     */
    public function index(InnovatorsRepository $innovatorsRepository): Response
    {
        return $this->render('innovators/index.html.twig', [
            'innovators' => $innovatorsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_innovators_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InnovatorsRepository $innovatorsRepository): Response
    {
        $innovator = new Innovators();
        $form = $this->createForm(Innovators1Type::class, $innovator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $innovatorsRepository->add($innovator, true);

            return $this->redirectToRoute('app_innovators_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('innovators/new.html.twig', [
            'innovator' => $innovator,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_innovators_show", methods={"GET"})
     */
    public function show(Innovators $innovator): Response
    {
        return $this->render('innovators/show.html.twig', [
            'innovator' => $innovator,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_innovators_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Innovators $innovator, InnovatorsRepository $innovatorsRepository): Response
    {
        $form = $this->createForm(Innovators1Type::class, $innovator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $innovatorsRepository->add($innovator, true);

            return $this->redirectToRoute('app_innovators_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('innovators/edit.html.twig', [
            'innovator' => $innovator,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_innovators_delete", methods={"POST"})
     */
    public function delete(Request $request, Innovators $innovator, InnovatorsRepository $innovatorsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$innovator->getId(), $request->request->get('_token'))) {
            $innovatorsRepository->remove($innovator, true);
        }

        return $this->redirectToRoute('app_innovators_index', [], Response::HTTP_SEE_OTHER);
    }
}
