<?php

namespace App\Service;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class CategorieService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        return $this->em->getRepository(Categorie::class)->findAll();
    }

    public function get($id)
    {
        return $this->em->getRepository(Categorie::class)->find($id);
    }

    public function create(Categorie $categorie)
    {
        $newCategorie = new Categorie();
        $newCategorie->setName($categorie->getName());

        $this->em->persist($newCategorie);
        $this->em->flush();
        return $newCategorie;
    }

    public function update(Categorie $categorie, $id): string
    {
        $existingCategorie = $this->em->getRepository(Categorie::class)->find($id);
        if ($existingCategorie) {
            $existingCategorie
                ->setName($categorie->getName() ?? $existingCategorie->getName());

            $this->em->flush();
            return "Le categorie possedant l'id {$id} a été mis a jour avec succès !";
        } else {
            return "Le categorie avec l'id {$id} n'a pas pu se mettre a jour.";
        }
    }
    public function patch(int $id, Categorie $oeuvre): string
    {
        $existingCategorie = $this->em->getRepository(Categorie::class)->find($id);

        if ($existingCategorie) {
            $existingCategorie->setTitle($oeuvre->getName() ?? $existingCategorie->getName());


            $this->em->flush();

            return "Le produit avec l'ID {$id} a été mis à jour avec succès !";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas.";
        }
    }

    public function delete(Categorie $categorie): void
    {
        try {
            $this->em->remove($categorie);
            $this->em->flush();
        } catch (Exception $e) {
            throw new Exception("Aucun ingredient avec l'id" . $categorie->getId() . "n'a été trouvé.");
        }
    }
}
