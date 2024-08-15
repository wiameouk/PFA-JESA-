<?php
namespace App\Controller;

use App\Entity\Approval;
use App\Form\ApprovalType;
use App\Repository\ApprovalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/approval')]
class ApprovalController extends AbstractController
{
    #[Route('/', name: 'approval_index', methods: ['GET'])]
    public function index(ApprovalRepository $approvalRepository): Response
    {
        return $this->render('approval/index.html.twig', [
            'approvals' => $approvalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'approval_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ApprovalRepository $approvalRepository): Response
    {
        $approval = new Approval();
        $form = $this->createForm(ApprovalType::class, $approval);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $approvalRepository->save($approval, true);
            return $this->redirectToRoute('approval_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('approval/new.html.twig', [
            'approval' => $approval,
            'form' => $form,
        ]);
    }

    // Add other CRUD methods (edit, delete, etc.)
}
