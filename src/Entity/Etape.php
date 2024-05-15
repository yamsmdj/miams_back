<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
#[Groups(['getEtape'])]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['getRecetteByIngredient'])]
    private ?int $n_etape = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['getRecetteByIngredient'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'etapes')]
    private ?Recette $recette = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['getRecette'])]
    public function getNEtape(): ?int
    {
        return $this->n_etape;
    }

    public function setNEtape(int $n_etape): static
    {
        $this->n_etape = $n_etape;

        return $this;
    }
    #[Groups(['getRecette'])]
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): static
    {
        $this->recette = $recette;

        return $this;
    }
}
