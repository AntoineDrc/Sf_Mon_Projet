<?php

namespace App\Entity;

use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $typeSeance = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateSeance = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, OrdreExercice>
     */
    #[ORM\OneToMany(targetEntity: OrdreExercice::class, mappedBy: 'seance', orphanRemoval: true)]
    private Collection $ordreExercices;

    public function __construct()
    {
        $this->ordreExercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeSeance(): ?string
    {
        return $this->typeSeance;
    }

    public function setTypeSeance(string $typeSeance): static
    {
        $this->typeSeance = $typeSeance;

        return $this;
    }

    public function getDateSeance(): ?\DateTimeInterface
    {
        return $this->dateSeance;
    }

    public function setDateSeance(\DateTimeInterface $dateSeance): static
    {
        $this->dateSeance = $dateSeance;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, OrdreExercice>
     */
    public function getOrdreExercices(): Collection
    {
        return $this->ordreExercices;
    }

    public function addOrdreExercice(OrdreExercice $ordreExercice): static
    {
        if (!$this->ordreExercices->contains($ordreExercice)) {
            $this->ordreExercices->add($ordreExercice);
            $ordreExercice->setSeance($this);
        }

        return $this;
    }

    public function removeOrdreExercice(OrdreExercice $ordreExercice): static
    {
        if ($this->ordreExercices->removeElement($ordreExercice)) {
            // set the owning side to null (unless already changed)
            if ($ordreExercice->getSeance() === $this) {
                $ordreExercice->setSeance(null);
            }
        }

        return $this;
    }
}
