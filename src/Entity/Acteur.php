<?php

namespace App\Entity;

use App\Repository\ActeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActeurRepository::class)]
class Acteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column]
    private ?\DateTime $dob = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dod = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bio = null;

    /**
     * @var Collection<int, Movie>
     */
    #[ORM\ManyToMany(targetEntity: Movie::class, inversedBy: 'acteurs')]
    private Collection $mouvies;

    public function __construct()
    {
        $this->mouvies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getDob(): ?\DateTime
    {
        return $this->dob;
    }

    public function setDob(\DateTime $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function getDod(): ?\DateTime
    {
        return $this->dod;
    }

    public function setDod(?\DateTime $dod): static
    {
        $this->dod = $dod;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMouvies(): Collection
    {
        return $this->mouvies;
    }

    public function addMouvy(Movie $mouvy): static
    {
        if (!$this->mouvies->contains($mouvy)) {
            $this->mouvies->add($mouvy);
        }

        return $this;
    }

    public function removeMouvy(Movie $mouvy): static
    {
        $this->mouvies->removeElement($mouvy);

        return $this;
    }
}
