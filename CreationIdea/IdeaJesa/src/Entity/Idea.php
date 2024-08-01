<?php

namespace App\Entity;

use App\Repository\IdeaRepository;
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

    #[ORM\Column]
    private ?bool $confidentiality = null;

    #[ORM\Column(length: 255)]
    private ?string $titleOfVc = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

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

    public function getTitleOfVc(): ?string
    {
        return $this->titleOfVc;
    }

    public function setTitleOfVc(string $titleOfVc): static
    {
        $this->titleOfVc = $titleOfVc;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
