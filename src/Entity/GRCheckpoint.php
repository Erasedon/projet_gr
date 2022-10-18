<?php

namespace App\Entity;

use App\Repository\GRCheckpointRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GRCheckpointRepository::class)]
class GRCheckpoint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_stands = null;

    #[ORM\ManyToMany(targetEntity: GRUser::class, inversedBy: 'GRCheckPoints')]
    private Collection $GRUser;

    public function __construct()
    {
        $this->GRUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStands(): ?string
    {
        return $this->nom_stands;
    }

    public function setNomStands(string $nom_stands): self
    {
        $this->nom_stands = $nom_stands;

        return $this;
    }

    /**
     * @return Collection<int, GRUser>
     */
    public function getGRUser(): Collection
    {
        return $this->GRUser;
    }

    public function addGRUser(GRUser $gRUser): self
    {
        if (!$this->GRUser->contains($gRUser)) {
            $this->GRUser->add($gRUser);
        }

        return $this;
    }

    public function removeGRUser(GRUser $gRUser): self
    {
        $this->GRUser->removeElement($gRUser);

        return $this;
    }
}
