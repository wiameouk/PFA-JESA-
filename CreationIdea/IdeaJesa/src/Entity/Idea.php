<?php
namespace App\Entity;

use App\Repository\IdeaRepository;
use App\Enum\IdeaSource;
use App\Enum\IdeaStatus;
use App\Enum\ProjectPhase;
use App\Enum\SectorsAndPrograms;
use App\Enum\TypesOfValueCreation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IdeaRepository::class)]
class Idea
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $projectNumber = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $confidentiality = null;

    #[ORM\Column(type: 'string', enumType: ProjectPhase::class)]
    private ?ProjectPhase $projectPhase = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(type: 'string', enumType: IdeaSource::class)]
    private ?IdeaSource $ideaSource = null;

    #[ORM\Column(type: 'string', enumType: IdeaStatus::class)]
    private ?IdeaStatus $ideaStatus = null;

    #[ORM\Column(type: 'string', enumType: SectorsAndPrograms::class)]
    private ?SectorsAndPrograms $sectorsAndPrograms = null;

    #[ORM\Column(type: 'json')]
    private array $typeOfVC = [];

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $department = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'idea_user')]
    private Collection $users;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Approval $Appro_idea = null;

    #[ORM\Column(length: 255)]
    private ?string $titleOfVC = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $customerName = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    // Getters et setters pour les propriétés existantes

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectNumber(): ?string
    {
        return $this->projectNumber;
    }

    public function setProjectNumber(string $projectNumber): static
    {
        $this->projectNumber = $projectNumber;
        return $this;
    }

    public function isConfidentiality(): ?bool
    {
        return $this->confidentiality;
    }

    public function setConfidentiality(bool $confidentiality): static
    {
        $this->confidentiality = $confidentiality;
        return $this;
    }

    public function getProjectPhase(): ?ProjectPhase
    {
        return $this->projectPhase;
    }

    public function setProjectPhase(?ProjectPhase $projectPhase): static
    {
        $this->projectPhase = $projectPhase;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getSectorsAndPrograms(): ?SectorsAndPrograms
    {
        return $this->sectorsAndPrograms;
    }

    public function setSectorsAndPrograms(?SectorsAndPrograms $sectorsAndPrograms): static
    {
        $this->sectorsAndPrograms = $sectorsAndPrograms;
        return $this;
    }
    public function getTypeOfVC(): array
    {
        return array_map(fn($type) => TypesOfValueCreation::from($type), $this->typeOfVC);
    }

public function setTypeOfVC(array $typeOfVC): static
    {
        $this->typeOfVC = array_map(fn($type) => $type->value, $typeOfVC);

        return $this;
    }


   
    public function getIdeaSource(): ?IdeaSource
    {
        return $this->ideaSource;
    }

    public function setIdeaSource(?IdeaSource $ideaSource): static
    {
        $this->ideaSource = $ideaSource;
        return $this;
    }

    public function getIdeaStatus(): ?IdeaStatus
    {
        return $this->ideaStatus;
    }

    public function setIdeaStatus(?IdeaStatus $ideaStatus): static
    {
        $this->ideaStatus = $ideaStatus;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addIdeaUser($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeIdeaUser($this);
        }

        return $this;
    }

    public function getApproIdea(): ?Approval
    {
        return $this->Appro_idea;
    }

    public function setApproIdea(?Approval $Appro_idea): static
    {
        $this->Appro_idea = $Appro_idea;
        return $this;
    }

    public function getTitleOfVC(): ?string
    {
        return $this->titleOfVC;
    }

    public function setTitleOfVC(string $titleOfVC): static
    {
        $this->titleOfVC = $titleOfVC;
        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): static
    {
        $this->department = $department;
        return $this;
    }

    // Getters et setters pour les nouveaux champs

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(?string $customerName): static
    {
        $this->customerName = $customerName;
        return $this;
    }
}
