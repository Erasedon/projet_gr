<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GRQuizzRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: GRQuizzRepository::class)]
class GRQuizz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $uuid;

    #[ORM\Column(length: 255)]
    private ?string $Question = null;

    #[ORM\Column(length: 100)]
    private ?string $Reponse1 = null;

    #[ORM\Column(length: 100)]
    private ?string $Reponse2 = null;

    #[ORM\Column(length: 100)]
    private ?string $Reponse3 = null;

    #[ORM\Column(length: 100)]
    private ?string $Reponse4 = null;

    #[ORM\ManyToOne(inversedBy: 'GRQuizzs')]
    private ?GRImage $GRImage = null;

    #[ORM\OneToMany(mappedBy: 'GRQuizz', targetEntity: GRStand::class)]
    private Collection $GRStands;

    #[ORM\Column(length: 100)]
    private ?string $BonneReponse = null;

    public function __construct()
    {
        $this->GRStands = new ArrayCollection();
        $uuid = Uuid::v6();
        $this->setUuid($uuid);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->Question;
    }

    public function setQuestion(string $Question): self
    {
        $this->Question = $Question;

        return $this;
    }

    public function getReponse1(): ?string
    {
        return $this->Reponse1;
    }

    public function setReponse1(string $Reponse1): self
    {
        $this->Reponse1 = $Reponse1;

        return $this;
    }

    public function getReponse2(): ?string
    {
        return $this->Reponse2;
    }

    public function setReponse2(string $Reponse2): self
    {
        $this->Reponse2 = $Reponse2;

        return $this;
    }

    public function getReponse3(): ?string
    {
        return $this->Reponse3;
    }

    public function setReponse3(string $Reponse3): self
    {
        $this->Reponse3 = $Reponse3;

        return $this;
    }

    public function getReponse4(): ?string
    {
        return $this->Reponse4;
    }

    public function setReponse4(string $Reponse4): self
    {
        $this->Reponse4 = $Reponse4;

        return $this;
    }

    public function getGRImage(): ?GRImage
    {
        return $this->GRImage;
    }

    public function setGRImage(?GRImage $GRImage): self
    {
        $this->GRImage = $GRImage;

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
            $gRStand->setGRQuizz($this);
        }

        return $this;
    }

    public function removeGRStand(GRStand $gRStand): self
    {
        if ($this->GRStands->removeElement($gRStand)) {
            // set the owning side to null (unless already changed)
            if ($gRStand->getGRQuizz() === $this) {
                $gRStand->setGRQuizz(null);
            }
        }

        return $this;
    }

    public function getBonneReponse(): ?string
    {
        return $this->BonneReponse;
    }

    public function setBonneReponse(string $BonneReponse): self
    {
        $this->BonneReponse = $BonneReponse;

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
}
