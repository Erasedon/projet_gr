<?php

namespace App\Entity;

use App\Repository\GRUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: GRUserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Cet Email existe déjà !')]
class GRUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

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

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column]
    private ?bool $Banned = null;

    #[ORM\ManyToMany(targetEntity: GRCheckpoint::class, mappedBy: 'GRUser')]
    private Collection $GRCheckPoints;

    public function __construct()
    {
        $this->GRCheckPoints = new ArrayCollection();
    }

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

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function isBanned(): ?bool
    {
        return $this->Banned;
    }

    public function setBanned(bool $Banned): self
    {
        $this->Banned = $Banned;

        return $this;
    }

    /**
     * @return Collection<int, GRCheckpoint>
     */
    public function getGRCheckPoints(): Collection
    {
        return $this->GRCheckPoints;
    }

    public function addGRCheckPoint(GRCheckpoint $gRCheckPoint): self
    {
        if (!$this->GRCheckPoints->contains($gRCheckPoint)) {
            $this->GRCheckPoints->add($gRCheckPoint);
            $gRCheckPoint->addGRUser($this);
        }

        return $this;
    }

    public function removeGRCheckPoint(GRCheckpoint $gRCheckPoint): self
    {
        if ($this->GRCheckPoints->removeElement($gRCheckPoint)) {
            $gRCheckPoint->removeGRUser($this);
        }

        return $this;
    }
}
