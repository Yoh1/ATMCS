<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSender;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idReceiver;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $sentAt;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSender(): ?Users
    {
        return $this->idSender;
    }

    public function setIdSender(?Users $idSender): self
    {
        $this->idSender = $idSender;

        return $this;
    }

    public function getIdReceiver(): ?Users
    {
        return $this->idReceiver;
    }

    public function setIdReceiver(?Users $idReceiver): self
    {
        $this->idReceiver = $idReceiver;

        return $this;
    }

    public function getSentAt(): ?\DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeImmutable $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
