<?php

namespace App\Entity;

use App\Repository\GRStandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GRStandRepository::class)]
class GRStand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $NomStand = null;

    #[ORM\Column(length: 255)]
    private ?string $PositionX = null;

    #[ORM\Column(length: 255)]
    private ?string $PositionY = null;

    #[ORM\Column]
    private ?int $NombreParticipant = null;

    #[ORM\ManyToOne(inversedBy: 'GRStands')]
    private ?GRTypeStand $Type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStand(): ?string
    {
        return $this->NomStand;
    }

    public function setNomStand(string $NomStand): self
    {
        $this->NomStand = $NomStand;

        return $this;
    }

    public function getPositionX(): ?string
    {
        return $this->PositionX;
    }

    public function setPositionX(string $PositionX): self
    {
        $this->PositionX = $PositionX;

        return $this;
    }

    public function getPositionY(): ?string
    {
        return $this->PositionY;
    }

    public function setPositionY(string $PositionY): self
    {
        $this->PositionY = $PositionY;

        return $this;
    }

    public function getNombreParticipant(): ?int
    {
        return $this->NombreParticipant;
    }

    public function setNombreParticipant(int $NombreParticipant): self
    {
        $this->NombreParticipant = $NombreParticipant;

        return $this;
    }

    public function getType(): ?GRTypeStand
    {
        return $this->Type;
    }

    public function setType(?GRTypeStand $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
