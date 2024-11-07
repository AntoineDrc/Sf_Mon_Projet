<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbReps = null;

    #[ORM\Column]
    private ?int $poid = null;

    #[ORM\ManyToOne(inversedBy: 'series')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercice $exercice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbReps(): ?int
    {
        return $this->nbReps;
    }

    public function setNbReps(int $nbReps): static
    {
        $this->nbReps = $nbReps;

        return $this;
    }

    public function getPoid(): ?int
    {
        return $this->poid;
    }

    public function setPoid(int $poid): static
    {
        $this->poid = $poid;

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): static
    {
        $this->exercice = $exercice;

        return $this;
    }
}
