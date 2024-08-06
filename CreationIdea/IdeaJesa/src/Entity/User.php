<?php
namespace App\Entity;

use App\Enum\RoleType;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'string', enumType: RoleType::class)]
    private RoleType $role;

    /**
     * @var Collection<int, idea>
     */
    #[ORM\ManyToMany(targetEntity: idea::class, inversedBy: 'users')]
    private Collection $idea_user;

    /**
     * @var Collection<int, Approval>
     */
    #[ORM\ManyToMany(targetEntity: Approval::class, inversedBy: 'users')]
    private Collection $Appoval_User;

    public function __construct()
    {
        $this->idea_user = new ArrayCollection();
        $this->Appoval_User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }
    public function setrole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

    public function getrole(): ?RoleType
    {
        return $this->role;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Collection<int, idea>
     */
    public function getIdeaUser(): Collection
    {
        return $this->idea_user;
    }

    public function addIdeaUser(idea $ideaUser): static
    {
        if (!$this->idea_user->contains($ideaUser)) {
            $this->idea_user->add($ideaUser);
        }

        return $this;
    }

    public function removeIdeaUser(idea $ideaUser): static
    {
        $this->idea_user->removeElement($ideaUser);

        return $this;
    }

    /**
     * @return Collection<int, Approval>
     */
    public function getAppovalUser(): Collection
    {
        return $this->Appoval_User;
    }

    public function addAppovalUser(Approval $appovalUser): static
    {
        if (!$this->Appoval_User->contains($appovalUser)) {
            $this->Appoval_User->add($appovalUser);
        }

        return $this;
    }

    public function removeAppovalUser(Approval $appovalUser): static
    {
        $this->Appoval_User->removeElement($appovalUser);

        return $this;
    }

}
