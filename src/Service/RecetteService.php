<?php

namespace App\Service;

use App\Entity\Categorie;
use App\Entity\Etape;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class RecetteService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        return $this->em->getRepository(Recette::class)->findAll();
    }

    public function get($id)
    {
        return $this->em->getRepository(Recette::class)->find($id);
    }

    
    public function create(Recette $recette)
    {
        $newRecette = new Recette();
        $newRecette->setTitle($recette->getTitle());
        $newRecette->setDescription($recette->getDescription());
        $newRecette->setTime($recette->getTime());
        $newRecette->setCreatedAt(new \DateTimeImmutable());
        $newRecette->setPicture($recette->getPicture());


        if ($recette->getCategorie()) {
            $categorieName = $recette->getCategorie()->getName();
            $categorie = $this->em->getRepository(Categorie::class)->findOneBy(['name' => $categorieName]);

            if ($categorie) {
                $newRecette->setCategorie($this->em->getReference(Categorie::class, $categorie->getId()));
            } else {
                throw new \Exception("La catégorie spécifiée n'existe pas.");
            }
        }
        foreach ($recette->getEtapes() as $index => $etape) {
            $newEtape = new Etape();
            $newEtape->setDescription($etape->getDescription());
            $newEtape->setNEtape($index + 1); // Vous attribuez le numéro d'étape
            $newEtape->setRecette($newRecette);
            $newRecette->addEtape($newEtape); // Supposons que vous ayez une méthode pour ajouter une étape à la recette
            $this->em->persist($newEtape);
        }
        

        $this->em->persist($newRecette);
        $this->em->flush();

        return $newRecette;
    }


    public function update(Recette $recette, $id): string
    {
        $existingRecette = $this->em->getRepository(Recette::class)->find($id);

        if ($existingRecette) {
            try {

                $existingRecette
                    ->setTitle($recette->getTitle())
                    ->setDescription($recette->getDescription())
                    ->setTime($recette->getTime())
                    ->setPicture($recette->getPicture());

                $this->em->flush();

                return "Le Recette possédant l'id {$id} a été mis à jour avec succès !";
            } catch (\Exception $e) {
                // Gérer les exceptions
                return "Une erreur s'est produite lors de la mise à jour de la recette : " . $e->getMessage();
            }
        } else {
            return "Le Recette avec l'id {$id} n'a pas pu être mis à jour car il n'existe pas.";
        }
    }
    public function patch(int $id, Recette $recette): string
    {
        $existingRecette = $this->em->getRepository(Recette::class)->find($id);

        if ($existingRecette) {
            $existingRecette->setTitle($recette->getTitle() ?? $existingRecette->getTitle());
            $existingRecette->setDescription($recette->getDescription() ?? $existingRecette->getDescription());
            $existingRecette->setTime($recette->getTime() ?? $existingRecette->getTime());
            $existingRecette->setPicture($recette->getPicture() ?? $existingRecette->getPicture());

            $existingRecette->clearEtapes();

            foreach ($recette->getEtapes() as $etape) {
                $existingRecette->addEtape($etape);
            }

            $this->em->flush();

            return "Le produit avec l'ID {$id} a été mis à jour avec succès !";
        } else {
            return "Le produit avec l'ID {$id} n'existe pas.";
        }
    }

    public function delete(Recette $recette): void
    {
        try {
            $this->em->remove($recette);
            $this->em->flush();
        } catch (Exception $e) {
            throw new Exception("Aucun ingredient avec l'id" . $recette->getId() . "n'a été trouvé.");
        }
    }
}
