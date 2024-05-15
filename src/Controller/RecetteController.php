<?php

namespace App\Controller;


use App\Entity\Recette;
use App\Repository\RecetteRepository;
use App\Service\RecetteService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;


#[Route('/api/recette')]
class RecetteController extends AbstractController
{
    private SerializerInterface $serializer;
    private RecetteService $recetteService;

    public function __construct(RecetteService $recetteService, SerializerInterface $serializer)
    {
        $this->recetteService = $recetteService;
        $this->serializer = $serializer;
    }

    #[Route('/', methods: ['GET'])]

    public function getAll(): Response
    {
        // // if (!$this->isGranted('ROLE_ADMIN')) {
        // //     dd($this->json($this->getUser()));
        // // }
        // dd($this->getUser());
        return new Response($this->serializer->serialize($this->recetteService->getAll(), 'json', ['groups' => 'getRecette', 'getEtape']));
    }
    #[Route('/{id}', methods: ['GET'])]
    public function get($id): Response
    {

        $recette = $this->recetteService->get($id);
        $data = $this->serializer->serialize($recette, 'json', ['groups' => 'getRecette']);

        return new Response($data);
    }

    #[Route('/', methods: ['POST'])]

    public function create(#[MapRequestPayload()] Recette $recette): Response
    {
        $recette = $this->recetteService->create($recette);
        $data = $this->serializer->serialize($recette, 'json', ['groups' => 'getRecette']);
        return new Response($data);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function put(#[MapRequestPayload()] Recette $newRecette, $id): Response
    {
        $recette = $this->recetteService->update($newRecette, $id);
        return new Response($recette);
    }

    #[Route('/{id}', methods: ['PATCH'])]
    public function patch(int $id, #[MapRequestPayload] Recette $recette): Response
    {
        $message = $this->recetteService->patch($id, $recette);
        return new Response($message);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function remove(Recette $recette): Response
    {
        try {
            $this->recetteService->delete($recette);
            return new Response("La recette" .  $recette->getTitle() . "a bien été supprimé", Response::HTTP_OK);
        } catch (Exception $e) {
            return new response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }


    #[Route('/ingredient/{ingredientName}', methods: ['GET'])]
    public function getRecipesByIngredient($ingredientName, RecetteRepository $recetteRepository): Response
    {
        $recettes = $recetteRepository->findRecettesByIngredient($ingredientName);
        $data = $this->serializer->serialize($recettes, 'json', ['groups' => 'getRecetteByIngredient']);
        return new Response($data, Response::HTTP_OK);
    }

    #[Route('/title/{title}', methods: ['GET'])]
    public function getByTitle($title, RecetteRepository $recetteRepository): Response
    {
        $recette = $recetteRepository->findRecetteByTitle($title);
        $data = $this->serializer->serialize($recette, 'json', ['groups' => 'getRecetteByIngredient']);
        return new Response($data, Response::HTTP_OK);
    }

    #[Route('/admin', methods: ['GET'])]
    public function getAllAdmin(): Response
    {
        return new Response($this->serializer->serialize($this->recetteService->getAll(), 'json', ['groups' => 'getRecette', 'getEtape']));
    }
    #[Route('/admin/{id}', methods: ['GET'])]
    public function getAdmin($id): Response
    {

        $recette = $this->recetteService->get($id);
        $data = $this->serializer->serialize($recette, 'json', ['groups' => 'getRecette']);

        return new Response($data);
    }
}
