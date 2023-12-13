<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Auteur $auteur = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Editeur $editeurs = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min:3,
        max:50,
        minMessage:"Le nom doit contenir au moins 4 caractères",
        maxMessage:"Le nom doit contenir au max 50 caractères"
    )]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\GreaterThanOrEqual(0)]
    #[Assert\NotNull()]
    private ?float $prix = null;

    #[ORM\Column]
    #[Assert\Positive()]
    #[Assert\NotNull]
    private ?int $quantite = null;

    #[ORM\Column(type:'string')]
    private ?string $couverture = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resume = null;

    public function getcouverture(): string
    {
        return $this->couverture;
    }

    public function setcouverture(string $couverture): self
    {
        $this->couverture = $couverture;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getEditeurs(): ?Editeur
    {
        return $this->editeurs;
    }

    public function setEditeurs(?Editeur $editeurs): static
    {
        $this->editeurs = $editeurs;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getGenreId(): ?Genre
    {
        return $this->genre_id;
    }

    public function setGenreId(?Genre $genre_id): static
    {
        $this->genre_id = $genre_id;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }
}