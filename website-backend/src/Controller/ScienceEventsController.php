<?php

namespace App\Controller;

use App\Entity\ScienceEvents;
use App\Form\ScienceEvents1Type;
use App\Repository\ScienceEventsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/science/events")
 */
class ScienceEventsController extends AbstractController
{
    /**
     * @Route("/", name="app_science_events_index", methods={"GET"})
     */
    public function index(ScienceEventsRepository $scienceEventsRepository): Response
    {
        return $this->render('science_events/index.html.twig', [
            'science_events' => $scienceEventsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_science_events_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ScienceEventsRepository $scienceEventsRepository): Response
    {
        $scienceEvent = new ScienceEvents();
        $form = $this->createForm(ScienceEvents1Type::class, $scienceEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scienceEventsRepository->add($scienceEvent, true);

            return $this->redirectToRoute('app_science_events_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('science_events/new.html.twig', [
            'science_event' => $scienceEvent,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_science_events_show", methods={"GET"})
     */
    public function show(ScienceEvents $scienceEvent): Response
    {
        return $this->render('science_events/show.html.twig', [
            'science_event' => $scienceEvent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_science_events_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ScienceEvents $scienceEvent, ScienceEventsRepository $scienceEventsRepository): Response
    {
        $form = $this->createForm(ScienceEvents1Type::class, $scienceEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scienceEventsRepository->add($scienceEvent, true);

            return $this->redirectToRoute('app_science_events_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('science_events/edit.html.twig', [
            'science_event' => $scienceEvent,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_science_events_delete", methods={"POST"})
     */
    public function delete(Request $request, ScienceEvents $scienceEvent, ScienceEventsRepository $scienceEventsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scienceEvent->getId(), $request->request->get('_token'))) {
            $scienceEventsRepository->remove($scienceEvent, true);
        }

        return $this->redirectToRoute('app_science_events_index', [], Response::HTTP_SEE_OTHER);
    }
}
