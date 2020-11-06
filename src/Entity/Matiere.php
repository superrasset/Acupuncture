<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $professeur;

    /**
     * @ORM\OneToMany(targetEntity=Synthese::class, mappedBy="matiere")
     */
    private $syntheses;

    public function __construct()
    {
        $this->syntheses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getProfesseur(): ?string
    {
        return $this->professeur;
    }

    public function setProfesseur(string $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * @return Collection|Synthese[]
     */
    public function getSyntheses(): Collection
    {
        return $this->syntheses;
    }

    public function addSynthesis(Synthese $synthesis): self
    {
        if (!$this->syntheses->contains($synthesis)) {
            $this->syntheses[] = $synthesis;
            $synthesis->setMatiere($this);
        }

        return $this;
    }

    public function removeSynthesis(Synthese $synthesis): self
    {
        if ($this->syntheses->contains($synthesis)) {
            $this->syntheses->removeElement($synthesis);
            // set the owning side to null (unless already changed)
            if ($synthesis->getMatiere() === $this) {
                $synthesis->setMatiere(null);
            }
        }

        return $this;
    }
}
