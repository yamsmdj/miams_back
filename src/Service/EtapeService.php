<?php

namespace App\Service;

use App\Entity\Etape;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class EtapeService  {
    
private EntityManagerInterface $em;

public function __construct(EntityManagerInterface $em)
{
    $this->em = $em;
}

public function getAll()
{
    return $this->em->getRepository(Etape::class)->findAll();
}

public function get($id)
{
    return $this->em->getRepository(Etape::class)->find($id);
}

public function create(Etape $etape)
{
    $newEtape = new Etape();
    $newEtape->setNEtape($etape->getNEtape());
    $newEtape->setDescription($etape->getDescription());
   
    $this->em->persist($newEtape);
    $this->em->flush();

    return $newEtape;
}


public function update(Etape $etape, $id): string
{
    $existingEtape = $this->em->getRepository(Etape::class)->find($id);

    if ($existingEtape) {
        try {

            $existingEtape
                ->setNETAPE($etape->getNETAPE())
                ->setDescription($etape->getDescription());

            $this->em->flush();

            return "Le Etape possédant l'id {$id} a été mis à jour avec succès !";
        } catch (\Exception $e) {
            // Gérer les exceptions
            return "Une erreur s'est produite lors de la mise à jour de la Etape : " . $e->getMessage();
        }
    } else {
        return "Le Etape avec l'id {$id} n'a pas pu être mis à jour car il n'existe pas.";
    }
}
public function patch(int $id, Etape $oeuvre): string
{
    $existingEtape = $this->em->getRepository(Etape::class)->find($id);

    if ($existingEtape) {
        $existingEtape->setNETAPE($oeuvre->getNETAPE() ?? $existingEtape->getNETAPE());
        $existingEtape->setDescription($oeuvre->getDescription() ?? $existingEtape->getDescription());

        $this->em->flush();

        return "Le produit avec l'ID {$id} a été mis à jour avec succès !";
    } else {
        return "Le produit avec l'ID {$id} n'existe pas.";
    }
}

public function delete(Etape $Etape): void
{
    try {
        $this->em->remove($Etape);
        $this->em->flush();
    } catch (Exception $e) {
        throw new Exception("Aucun ingredient avec l'id" . $Etape->getId() . "n'a été trouvé.");
    }
}
}