<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;
use App\Repository\GRStandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GRStandRepository::class)]
class GRStand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $uuid;

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

    #[ORM\Column(length: 255)]
    private ?string $qr_code = null;

    #[ORM\OneToMany(mappedBy: 'GRStand', targetEntity: GRQuizz::class)]
    private Collection $GRQuizzs;

    public function __construct()
    {
        $uuid = Uuid::v6();
        $this->setUuid($uuid);
        $this->GRQuizzs = new ArrayCollection();
    }
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

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getQrCode(): ?string
    {
        return $this->qr_code;
    }

    public function setQrCode(string $qr_code): self
    {
        $this->qr_code = $qr_code;

        return $this;
    }

    /**
     * @return Collection<int, GRQuizz>
     */
    public function getGRQuizzs(): Collection
    {
        return $this->GRQuizzs;
    }

    public function addGRQuizz(GRQuizz $gRQuizz): self
    {
        if (!$this->GRQuizzs->contains($gRQuizz)) {
            $this->GRQuizzs->add($gRQuizz);
            $gRQuizz->setGRStand($this);
        }

        return $this;
    }

    public function removeGRQuizz(GRQuizz $gRQuizz): self
    {
        if ($this->GRQuizzs->removeElement($gRQuizz)) {
            // set the owning side to null (unless already changed)
            if ($gRQuizz->getGRStand() === $this) {
                $gRQuizz->setGRStand(null);
            }
        }

        return $this;
    }
}
