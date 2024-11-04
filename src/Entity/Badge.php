<?php

namespace App\Entity;

use App\Repository\BadgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
class Badge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $critere = null;

    /**
     * @var Collection<int, BadgeObtenu>
     */
    #[ORM\OneToMany(targetEntity: BadgeObtenu::class, mappedBy: 'badge', orphanRemoval: true)]
    private Collection $badgeObtenus;

    public function __construct()
    {
        $this->badgeObtenus = new ArrayCollection();
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

    public function getCritere(): ?string
    {
        return $this->critere;
    }

    public function setCritere(string $critere): static
    {
        $this->critere = $critere;

        return $this;
    }

    /**
     * @return Collection<int, BadgeObtenu>
     */
    public function getBadgeObtenus(): Collection
    {
        return $this->badgeObtenus;
    }

    public function addBadgeObtenu(BadgeObtenu $badgeObtenu): static
    {
        if (!$this->badgeObtenus->contains($badgeObtenu)) {
            $this->badgeObtenus->add($badgeObtenu);
            $badgeObtenu->setBadge($this);
        }

        return $this;
    }

    public function removeBadgeObtenu(BadgeObtenu $badgeObtenu): static
    {
        if ($this->badgeObtenus->removeElement($badgeObtenu)) {
            // set the owning side to null (unless already changed)
            if ($badgeObtenu->getBadge() === $this) {
                $badgeObtenu->setBadge(null);
            }
        }

        return $this;
    }
}
