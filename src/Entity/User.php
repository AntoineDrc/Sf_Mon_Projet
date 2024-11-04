<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(length: 20)]
    private ?string $role = null;

    #[ORM\Column]
    private ?int $xp = null;

    #[ORM\Column]
    private ?int $niveau = null;

    #[ORM\Column(length: 50)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    /**
     * @var Collection<int, Seance>
     */
    #[ORM\OneToMany(targetEntity: Seance::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $seances;

    /**
     * @var Collection<int, BadgeObtenu>
     */
    #[ORM\OneToMany(targetEntity: BadgeObtenu::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $badgeObtenus;

    public function __construct()
    {
        $this->seances = new ArrayCollection();
        $this->badgeObtenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getXp(): ?int
    {
        return $this->xp;
    }

    public function setXp(int $xp): static
    {
        $this->xp = $xp;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Seance>
     */
    public function getSeances(): Collection
    {
        return $this->seances;
    }

    public function addSeance(Seance $seance): static
    {
        if (!$this->seances->contains($seance)) {
            $this->seances->add($seance);
            $seance->setUser($this);
        }

        return $this;
    }

    public function removeSeance(Seance $seance): static
    {
        if ($this->seances->removeElement($seance)) {
            // set the owning side to null (unless already changed)
            if ($seance->getUser() === $this) {
                $seance->setUser(null);
            }
        }

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
            $badgeObtenu->setUser($this);
        }

        return $this;
    }

    public function removeBadgeObtenu(BadgeObtenu $badgeObtenu): static
    {
        if ($this->badgeObtenus->removeElement($badgeObtenu)) {
            // set the owning side to null (unless already changed)
            if ($badgeObtenu->getUser() === $this) {
                $badgeObtenu->setUser(null);
            }
        }

        return $this;
    }
}
