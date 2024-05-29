<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 *
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    /**
     * @return Recette[]
     */
    public function findRecettesByIngredient($ingredientName){
        return $this->createQueryBuilder('r')
        ->innerJoin('r.ingredient', 'i')
        ->where('LOWER(i.name) LIKE :ingredientName')
        ->setParameter('ingredientName','%' . $ingredientName . '%')
        ->getQuery()
        ->getResult();
    }

    public function findRecetteByTitle($title)
    {
        $title = str_replace(' ', '_', $title);

        return $this->createQueryBuilder('r')
            ->where('r.title LIKE :title')
            ->setParameter('title', '%'.$title.'%')
            ->getQuery()
            ->getResult();
    }

}
