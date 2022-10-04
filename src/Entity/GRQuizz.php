<?php

namespace App\Entity;

use App\Repository\GRQuizzRepository;
use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\ManyToOne(inversedBy: 'GRQuizzs')]
    private ?GRImage $GRImage = null;

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
}
