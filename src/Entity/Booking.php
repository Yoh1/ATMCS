<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\OneToOne(targetEntity=Car::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCar;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $bookedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?Users
    {
        return $this->idUser;
    }

    public function setIdUser(?Users $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdCar(): ?Car
    {
        return $this->idCar;
    }

    public function setIdCar(Car $idCar): self
    {
        $this->idCar = $idCar;

        return $this;
    }

    public function getBookedAt(): ?\DateTimeImmutable
    {
        return $this->bookedAt;
    }

    public function setBookedAt(\DateTimeImmutable $bookedAt): self
    {
        $this->bookedAt = $bookedAt;

        return $this;
    }
}
