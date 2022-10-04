<?php

namespace App\Entity;

use App\Repository\GRUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: GRUserRepository::class)]
class GRUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $telephone = null;

    #[ORM\Column(nullable: true)]
    private ?int $classement = null;

    #[ORM\Column]
    private ?bool $stand1 = null;

    #[ORM\Column]
    private ?bool $stand2 = null;

    #[ORM\Column]
    private ?bool $stand3 = null;

    #[ORM\Column]
    private ?bool $stand4 = null;

    #[ORM\Column]
    private ?bool $stand5 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getClassement(): ?int
    {
        return $this->classement;
    }

    public function setClassement(?int $classement): self
    {
        $this->classement = $classement;

        return $this;
    }

    public function isStand1(): ?bool
    {
        return $this->stand1;
    }

    public function setStand1(bool $stand1): self
    {
        $this->stand1 = $stand1;

        return $this;
    }

    public function isStand2(): ?bool
    {
        return $this->stand2;
    }

    public function setStand2(bool $stand2): self
    {
        $this->stand2 = $stand2;

        return $this;
    }

    public function isStand3(): ?bool
    {
        return $this->stand3;
    }

    public function setStand3(bool $stand3): self
    {
        $this->stand3 = $stand3;

        return $this;
    }

    public function isStand4(): ?bool
    {
        return $this->stand4;
    }

    public function setStand4(bool $stand4): self
    {
        $this->stand4 = $stand4;

        return $this;
    }

    public function isStand5(): ?bool
    {
        return $this->stand5;
    }

    public function setStand5(bool $stand5): self
    {
        $this->stand5 = $stand5;

        return $this;
    }
}
