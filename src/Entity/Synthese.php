<?php

namespace App\Entity;

use App\Repository\SyntheseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SyntheseRepository::class)
 */
class Synthese
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="syntheses")
     */
    private $matiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreMaxParticipants;

    /**
     * @ORM\Column(type="integer")
     */
    private $NombreParticipants;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getNombreMaxParticipants(): ?int
    {
        return $this->nombreMaxParticipants;
    }

    public function setNombreMaxParticipants(int $nombreMaxParticipants): self
    {
        $this->nombreMaxParticipants = $nombreMaxParticipants;

        return $this;
    }

    public function getNombreParticipants(): ?int
    {
        return $this->NombreParticipants;
    }

    public function setNombreParticipants(int $NombreParticipants): self
    {
        $this->NombreParticipants = $NombreParticipants;

        return $this;
    }
}
