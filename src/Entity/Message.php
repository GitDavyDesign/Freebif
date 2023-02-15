<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mess = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Discussing $discussing = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $message_author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMess(): ?string
    {
        return $this->mess;
    }

    public function setMess(string $mess): self
    {
        $this->mess = $mess;

        return $this;
    }

    public function getDiscussing(): ?Discussing
    {
        return $this->discussing;
    }

    public function setDiscussing(?Discussing $discussing): self
    {
        $this->discussing = $discussing;

        return $this;
    }

    public function getMessage_author(): ?User
    {
        return $this->message_author;
    }

    public function setMessage_author(?User $message_author): self
    {
        $this->message_author = $message_author;

        return $this;
    }

}
