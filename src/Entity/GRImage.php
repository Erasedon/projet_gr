<?php

namespace App\Entity;

use App\Repository\GRImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GRImageRepository::class)]
class GRImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Link = null;

    #[ORM\OneToMany(mappedBy: 'GRImage', targetEntity: GRQuizz::class)]
    private Collection $GRQuizzs;

    public function __construct()
    {
        $this->GRQuizzs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->Link;
    }

    public function setLink(string $Link): self
    {
        $this->Link = $Link;

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
            $gRQuizz->setGRImage($this);
        }

        return $this;
    }

    public function removeGRQuizz(GRQuizz $gRQuizz): self
    {
        if ($this->GRQuizzs->removeElement($gRQuizz)) {
            // set the owning side to null (unless already changed)
            if ($gRQuizz->getGRImage() === $this) {
                $gRQuizz->setGRImage(null);
            }
        }

        return $this;
    }
}
