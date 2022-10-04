<?php

namespace App\Entity;

use App\Repository\GRTypeStandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GRTypeStandRepository::class)]
class GRTypeStand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomType = null;

    #[ORM\OneToMany(mappedBy: 'Type', targetEntity: GRStand::class)]
    private Collection $GRStands;

    public function __construct()
    {
        $this->GRStands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomType(): ?string
    {
        return $this->NomType;
    }

    public function setNomType(string $NomType): self
    {
        $this->NomType = $NomType;

        return $this;
    }

    /**
     * @return Collection<int, GRStand>
     */
    public function getGRStands(): Collection
    {
        return $this->GRStands;
    }

    public function addGRStand(GRStand $gRStand): self
    {
        if (!$this->GRStands->contains($gRStand)) {
            $this->GRStands->add($gRStand);
            $gRStand->setType($this);
        }

        return $this;
    }

    public function removeGRStand(GRStand $gRStand): self
    {
        if ($this->GRStands->removeElement($gRStand)) {
            // set the owning side to null (unless already changed)
            if ($gRStand->getType() === $this) {
                $gRStand->setType(null);
            }
        }

        return $this;
    }
}
