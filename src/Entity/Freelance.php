<?php

namespace App\Entity;

use App\Repository\FreelanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FreelanceRepository::class)]
class Freelance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $categories = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $experience = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $skills = [];

    #[ORM\Column(length: 255)]
    private ?string $localisation = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $choiceLocalisation = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $freePhone = null;

    #[ORM\Column(length: 255)]
    private ?string $presentation = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $portfolio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getExperience(): array
    {
        return $this->experience;
    }

    public function setExperience(array $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkills(array $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getChoiceLocalisation(): array
    {
        return $this->choiceLocalisation;
    }

    public function setChoiceLocalisation(array $choiceLocalisation): self
    {
        $this->choiceLocalisation = $choiceLocalisation;

        return $this;
    }

    public function getFreePhone(): ?string
    {
        return $this->freePhone;
    }

    public function setFreePhone(?string $freePhone): self
    {
        $this->freePhone = $freePhone;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPortfolio(): ?string
    {
        return $this->portfolio;
    }

    public function setPortfolio(?string $portfolio): self
    {
        $this->portfolio = $portfolio;

        return $this;
    }
}
