<?php

namespace App\Entity;

use App\Repository\GRUsersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GRUsersRepository::class)]
class GRUsers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 15)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 100)]
    private ?string $AdresseEmail = null;

    #[ORM\Column(length: 255)]
    private ?string $Password = null;

    #[ORM\Column]
    private ?int $Classement = null;

    #[ORM\Column]
    private ?bool $Stand1 = null;

    #[ORM\Column]
    private ?bool $Stand2 = null;

    #[ORM\Column]
    private ?bool $Stand3 = null;

    #[ORM\Column]
    private ?bool $Stand4 = null;

    #[ORM\Column]
    private ?bool $Stand5 = null;

    #[ORM\Column]
    private array $Role = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getAdresseEmail(): ?string
    {
        return $this->AdresseEmail;
    }

    public function setAdresseEmail(string $AdresseEmail): self
    {
        $this->AdresseEmail = $AdresseEmail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getClassement(): ?int
    {
        return $this->Classement;
    }

    public function setClassement(int $Classement): self
    {
        $this->Classement = $Classement;

        return $this;
    }

    public function isStand1(): ?bool
    {
        return $this->Stand1;
    }

    public function setStand1(bool $Stand1): self
    {
        $this->Stand1 = $Stand1;

        return $this;
    }

    public function isStand2(): ?bool
    {
        return $this->Stand2;
    }

    public function setStand2(bool $Stand2): self
    {
        $this->Stand2 = $Stand2;

        return $this;
    }

    public function isStand3(): ?bool
    {
        return $this->Stand3;
    }

    public function setStand3(bool $Stand3): self
    {
        $this->Stand3 = $Stand3;

        return $this;
    }

    public function isStand4(): ?bool
    {
        return $this->Stand4;
    }

    public function setStand4(bool $Stand4): self
    {
        $this->Stand4 = $Stand4;

        return $this;
    }

    public function isStand5(): ?bool
    {
        return $this->Stand5;
    }

    public function setStand5(bool $Stand5): self
    {
        $this->Stand5 = $Stand5;

        return $this;
    }

    public function getRole(): array
    {
        return $this->Role;
    }

    public function setRole(array $Role): self
    {
        $this->Role = $Role;

        return $this;
    }
}
