<?php

namespace App\Entity;

use App\Enum\ApprovalStatus;
use App\Repository\ApprovalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprovalRepository::class)]
class Approval
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', enumType: ApprovalStatus::class)]
    private ApprovalStatus $approvalStatus;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateApprouval = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'approvals')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApprovalStatus(): ApprovalStatus
    {
        return $this->approvalStatus;
    }

    public function setApprovalStatus(ApprovalStatus $approvalStatus): static
    {
        $this->approvalStatus = $approvalStatus;
        return $this;
    }

    public function getDateApprouval(): ?\DateTimeInterface
    {
        return $this->DateApprouval;
    }

    public function setDateApprouval(\DateTimeInterface $DateApprouval): static
    {
        $this->DateApprouval = $DateApprouval;
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

    public function getUsers(): Collection
    {
        return $this->users;
    }
    


}
