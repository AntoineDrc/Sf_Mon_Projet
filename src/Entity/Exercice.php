<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    /**
     * @var Collection<int, OrdreExercice>
     */
    #[ORM\OneToMany(targetEntity: OrdreExercice::class, mappedBy: 'exercice', orphanRemoval: true)]
    private Collection $ordreExercices;

    /**
     * @var Collection<int, Serie>
     */
    #[ORM\ManyToMany(targetEntity: Serie::class, inversedBy: 'exercices')]
    private Collection $series;

    public function __construct()
    {
        $this->ordreExercices = new ArrayCollection();
        $this->series = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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
            $ordreExercice->setExercice($this);
        }

        return $this;
    }

    public function removeOrdreExercice(OrdreExercice $ordreExercice): static
    {
        if ($this->ordreExercices->removeElement($ordreExercice)) {
            // set the owning side to null (unless already changed)
            if ($ordreExercice->getExercice() === $this) {
                $ordreExercice->setExercice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Serie $series): static
    {
        if (!$this->series->contains($series)) {
            $this->series->add($series);
        }

        return $this;
    }

    public function removeSeries(Serie $series): static
    {
        $this->series->removeElement($series);

        return $this;
    }
}
