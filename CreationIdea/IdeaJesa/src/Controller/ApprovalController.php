<?php

namespace App\Controller;

use App\Entity\Approval;
use App\Form\ApprovalType;
use App\Repository\ApprovalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApprovalController extends AbstractController
{
    #[Route('/approvals', name: 'approval_index', methods: ['GET'])]
    public function index(ApprovalRepository $approvalRepository): Response
    {
        return $this->render('approval/index.html.twig', [
            'approvals' => $approvalRepository->findAll(),
        ]);
    }

    #[Route('/approvals/new', name: 'approval_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $approval = new Approval();
        $form = $this->createForm(ApprovalType::class, $approval);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($approval);
            $em->flush();

            return $this->redirectToRoute('approval_index');
        }

        return $this->render('approval/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/approvals/{id}', name: 'approval_show', methods: ['GET'])]
    public function show(Approval $approval): Response
    {
        return $this->render('approval/show.html.twig', [
            'approval' => $approval,
        ]);
    }

    #[Route('/approvals/{id}/edit', name: 'approval_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Approval $approval, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ApprovalType::class, $approval);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('approval_index');
        }

        return $this->render('approval/edit.html.twig', [
            'form' => $form->createView(),
            'approval' => $approval,
        ]);
    }

    #[Route('/approvals/{id}', name: 'approval_delete', methods: ['POST'])]
    public function delete(Request $request, Approval $approval, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$approval->getId(), $request->request->get('_token'))) {
            $em->remove($approval);
            $em->flush();
        }

        return $this->redirectToRoute('approval_index');
    }
}
