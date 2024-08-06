<?php 
namespace App\Controller;

use App\Entity\Idea;
use App\Entity\User;

use App\Enum\SectorsAndPrograms;
use App\Enum\ProjectPhase;
use App\Enum\IdeaSource;
use App\Enum\IdeaStatus;
use App\Enum\TypesOfValueCreation;
use App\Repository\IdeaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IdeaController extends AbstractController
{
    /**
     * @Route("/ideas", name="idea_index", methods={"GET"})
     */
    public function index(IdeaRepository $ideaRepository): Response
    {
        $ideas = $ideaRepository->findAll();
        return $this->json($ideas);
    }

    /**
     * @Route("/ideas", name="idea_create", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {
        $data = json_decode($request->getContent(), true);

        $idea = new Idea();
        $idea->setProjectNumber($data['projectNumber']);
        $idea->setSectorsAndPrograms(SectorsAndPrograms::from($data['sectorAndProgram']));
        $idea->setConfidentiality($data['confidentiality']);
        $idea->setTitleOfVC($data['titleOVC']);
        $idea->setDescription($data['description']);
        $idea->setIdeaSource(IdeaSource::from($data['ideaSource']));
        $idea->setIdeaStatus(IdeaStatus::from($data['ideaStatus']));
        $idea->setProjectPhase(ProjectPhase::from($data['projectPhase']));

        $typesOfVC = [];
        foreach ($data['typeOfVC'] as $type) {
            $typesOfVC[] = TypesOfValueCreation::from($type);
        }
        $idea->settypeOfVC($typesOfVC);

        // Handle many-to-many relationships
        foreach ($data['organisator'] as $userId) {
            $user = $entityManager->getRepository(User::class)->find($userId);
            if ($user) {
                $idea->addUser($user);
            }
        }

        $errors = $validator->validate($idea);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($idea);
        $entityManager->flush();

        return $this->json($idea, Response::HTTP_CREATED);
    }
}
