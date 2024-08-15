<?php 
namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use App\Repository\IdeaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IdeaController extends AbstractController
{
    #[Route('/ideas', name: 'idea_index', methods: ['GET'])]
    public function index(IdeaRepository $ideaRepository): Response
    {
        $ideas = $ideaRepository->findAll();
        return $this->render('idea/index.html.twig', [
            'ideas' => $ideas,
        ]);
    }

    #[Route('/ideas/new', name: 'idea_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $idea = new Idea();
        $form = $this->createForm(IdeaType::class, $idea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($idea);
            $entityManager->flush();

            return $this->redirectToRoute('idea_index');
        }

        return $this->render('idea/new.html.twig', [
            'idea' => $idea,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ideas/{id}', name: 'idea_show', methods: ['GET'])]
    public function show(Idea $idea): Response
    {
        return $this->render('idea/show.html.twig', [
            'idea' => $idea,
        ]);
    }

    #[Route('/ideas/{id}/edit', name: 'idea_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Idea $idea, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IdeaType::class, $idea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('idea_index');
        }

        return $this->render('idea/edit.html.twig', [
            'idea' => $idea,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ideas/{id}/delete', name: 'idea_delete', methods: ['POST'])]
    public function delete(Request $request, Idea $idea, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$idea->getId(), $request->request->get('_token'))) {
            $entityManager->remove($idea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('idea_index');
    }
}
