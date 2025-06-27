<?php

namespace App\Controller;

use App\Entity\CouncilMembers;
use App\Form\CouncilMembers1Type;
use App\Repository\CouncilMembersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/council/members")
 */
class CouncilMembersController extends AbstractController
{
    /**
     * @Route("/", name="app_council_members_index", methods={"GET"})
     */
    public function index(CouncilMembersRepository $councilMembersRepository): Response
    {
        return $this->render('council_members/index.html.twig', [
            'council_members' => $councilMembersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_council_members_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CouncilMembersRepository $councilMembersRepository): Response
    {
        $councilMember = new CouncilMembers();
        $form = $this->createForm(CouncilMembers1Type::class, $councilMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $councilMembersRepository->add($councilMember, true);

            return $this->redirectToRoute('app_council_members_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('council_members/new.html.twig', [
            'council_member' => $councilMember,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_council_members_show", methods={"GET"})
     */
    public function show(CouncilMembers $councilMember): Response
    {
        return $this->render('council_members/show.html.twig', [
            'council_member' => $councilMember,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_council_members_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CouncilMembers $councilMember, CouncilMembersRepository $councilMembersRepository): Response
    {
        $form = $this->createForm(CouncilMembers1Type::class, $councilMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $councilMembersRepository->add($councilMember, true);

            return $this->redirectToRoute('app_council_members_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('council_members/edit.html.twig', [
            'council_member' => $councilMember,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_council_members_delete", methods={"POST"})
     */
    public function delete(Request $request, CouncilMembers $councilMember, CouncilMembersRepository $councilMembersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$councilMember->getId(), $request->request->get('_token'))) {
            $councilMembersRepository->remove($councilMember, true);
        }

        return $this->redirectToRoute('app_council_members_index', [], Response::HTTP_SEE_OTHER);
    }
}
