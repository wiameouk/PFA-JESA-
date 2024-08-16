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
        return $this->render('idea/index.html.twig', [
            'ideas' => $ideaRepository->findAll(),
        ]);
    }

    #[Route('/ideas/new', name: 'idea_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $idea = new Idea();
        $form = $this->createForm(IdeaType::class, $idea);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($idea);
            $em->flush();

            return $this->redirectToRoute('idea_index');
        }

        return $this->render('idea/new.html.twig', [
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
    public function edit(Request $request, Idea $idea, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(IdeaType::class, $idea);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('idea_index');
        }

        return $this->render('idea/edit.html.twig', [
            'form' => $form->createView(),
            'idea' => $idea,
        ]);
    }

    #[Route('/ideas/{id}', name: 'idea_delete', methods: ['POST'])]
    public function delete(Request $request, Idea $idea, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$idea->getId(), $request->request->get('_token'))) {
            $em->remove($idea);
            $em->flush();
        }

        return $this->redirectToRoute('idea_index');
    }
}
