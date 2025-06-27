<?php

namespace App\Controller;

use App\Entity\IksCouncilMembers;
use App\Form\IksCouncilMembers1Type;
use App\Repository\IksCouncilMembersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/iks/council/members")
 */
class IksCouncilMembersController extends AbstractController
{
    /**
     * @Route("/", name="app_iks_council_members_index", methods={"GET"})
     */
    public function index(IksCouncilMembersRepository $iksCouncilMembersRepository): Response
    {
        return $this->render('iks_council_members/index.html.twig', [
            'iks_council_members' => $iksCouncilMembersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_iks_council_members_new", methods={"GET", "POST"})
     */
    public function new(Request $request, IksCouncilMembersRepository $iksCouncilMembersRepository): Response
    {
        $iksCouncilMember = new IksCouncilMembers();
        $form = $this->createForm(IksCouncilMembers1Type::class, $iksCouncilMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksCouncilMembersRepository->add($iksCouncilMember, true);

            return $this->redirectToRoute('app_iks_council_members_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_council_members/new.html.twig', [
            'iks_council_member' => $iksCouncilMember,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_council_members_show", methods={"GET"})
     */
    public function show(IksCouncilMembers $iksCouncilMember): Response
    {
        return $this->render('iks_council_members/show.html.twig', [
            'iks_council_member' => $iksCouncilMember,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_iks_council_members_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, IksCouncilMembers $iksCouncilMember, IksCouncilMembersRepository $iksCouncilMembersRepository): Response
    {
        $form = $this->createForm(IksCouncilMembers1Type::class, $iksCouncilMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $iksCouncilMembersRepository->add($iksCouncilMember, true);

            return $this->redirectToRoute('app_iks_council_members_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('iks_council_members/edit.html.twig', [
            'iks_council_member' => $iksCouncilMember,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_iks_council_members_delete", methods={"POST"})
     */
    public function delete(Request $request, IksCouncilMembers $iksCouncilMember, IksCouncilMembersRepository $iksCouncilMembersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$iksCouncilMember->getId(), $request->request->get('_token'))) {
            $iksCouncilMembersRepository->remove($iksCouncilMember, true);
        }

        return $this->redirectToRoute('app_iks_council_members_index', [], Response::HTTP_SEE_OTHER);
    }
}
