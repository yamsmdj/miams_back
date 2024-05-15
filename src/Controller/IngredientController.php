<?php

namespace App\Controller;


use App\Entity\Ingredient;
use App\Service\IngredientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/ingredient')]
class IngredientController extends AbstractController
{
    private SerializerInterface $serializer;
    private IngredientService $ingredientService;

    public function __construct(IngredientService $ingredientService, SerializerInterface $serializer)
    {
        $this->ingredientService = $ingredientService;
        $this->serializer = $serializer;
    }

    #[Route('/', methods: ['GET'])]
    public function getAll(): Response
    {
        $ingredient = $this->ingredientService->getAll();
        $data = $this->serializer->serialize($ingredient, 'json', ['groups' => 'getIngredient']);
        return new Response($data);
    }
    #[Route('/{id}')]
    public function get($id): Response
    {
        $ingredient = $this->ingredientService->get($id);
        $data = $this->serializer->serialize($ingredient, 'json', ['groups' => 'getIngredient']);
        return new Response($data);
    }

    #[Route('/', methods: ['POST'])]
    public function create(#[MapRequestPayload()] Ingredient $ingredient): Response
    {
        $ingredient = $this->ingredientService->create($ingredient);
        $data = $this->serializer->serialize($ingredient, 'json');
        return new Response($data);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function put(Ingredient $newIngredient, $id): Response
    {
        $ingredient = $this->ingredientService->update($newIngredient, $id);
        return new Response($ingredient);
    }


}
