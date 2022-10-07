<?php

namespace App\Entity;

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

    #[ORM\Column(length: 100)]
    private ?string $BonneReponse = null;

    #[ORM\ManyToOne(inversedBy: 'GRQuizzs')]
    private ?GRStand $GRStand = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $points = null;

    public function __construct()
    {
        $this->GRStands = new ArrayCollection();
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

    public function getBonneReponse(): ?string
    {
        return $this->BonneReponse;
    }

    public function setBonneReponse(string $BonneReponse): self
    {
        $this->BonneReponse = $BonneReponse;

        return $this;
    }

    public function getGRStand(): ?GRStand
    {
        return $this->GRStand;
    }

    public function setGRStand(?GRStand $GRStand): self
    {
        $this->GRStand = $GRStand;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }
}
