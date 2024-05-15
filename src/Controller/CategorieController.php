<?php

namespace App\Controller;


use App\Entity\Categorie;
use App\Service\CategorieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/categorie')]
class CategorieController extends AbstractController
{
    private SerializerInterface $serializer;
    private CategorieService $categorieService;

    public function __construct(CategorieService $categorieService, SerializerInterface $serializer)
    {
        $this->categorieService = $categorieService;
        $this->serializer = $serializer;
    }

    #[Route('/', methods: ['GET'])]
    public function getAll(): Response
    {
        $categorie = $this->categorieService->getAll();
        $data = $this->serializer->serialize($categorie, 'json', ['groups' => 'getCategorie']);
        return new Response($data);
    }
    #[Route('/{id}', methods:['GET'])]
    public function get($id): Response
    {
        $categorie = $this->categorieService->get($id);
        $data = $this->serializer->serialize($categorie, 'json', ['groups' => 'getCategorie']);
        return new Response($data);
    }

    #[Route('/', methods: ['POST'])]
    public function create(#[MapRequestPayload()] Categorie $categorie): Response
    {
        $categorie = $this->categorieService->create($categorie);
        $data = $this->serializer->serialize($categorie, 'json');
        return new Response($data);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function put(Categorie $newCategorie, $id): Response
    {
        $categorie = $this->categorieService->update($newCategorie, $id);
        return new Response($categorie);
    }


}
