<?php

namespace App\Service;

use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class IngredientService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        return $this->em->getRepository(Ingredient::class)->findAll();
    }

    public function get($id)
    {
        return $this->em->getRepository(Ingredient::class)->find($id);
    }

    public function create(Ingredient $ingredient)
    {
        $newIngredient = new Ingredient();
        $newIngredient->setName($ingredient->getName());


        $this->em->persist($newIngredient);
        $this->em->flush();
        return $newIngredient;
    }

    public function update(Ingredient $ingredient, $id): string
    {
        $existingIngredient = $this->em->getRepository(Ingredient::class)->find($id);
        if ($existingIngredient) {
            $existingIngredient
                ->setName($ingredient->getName() ?? $existingIngredient->getName());

            $this->em->flush();
            return "Le Ingredient possedant l'id {$id} a été mis a jour avec succès !";
        } else {
            return "Le Ingredient avec l'id {$id} n'a pas pu se mettre a jour.";
        }
    }

    public function patch(int $id, Ingredient $ingredient): string
    {
        $existingIngredient = $this->em->getRepository(Ingredient::class)->find($id);

        if ($existingIngredient) {
            $existingIngredient->setTitle($ingredient->getName() ?? $existingIngredient->getName());
            $this->em->flush();

            return "Le produit avec l'ID {$id} a été mis à jour avec succès !";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas.";
        }
    }

    public function delete(Ingredient $ingredient): void
    {
        try {
            $this->em->remove($ingredient);
            $this->em->flush();
        } catch (Exception $e) {
            throw new Exception("Aucun ingredient avec l'id" . $ingredient->getId() . "n'a été trouvé.");
        }
    }
}
