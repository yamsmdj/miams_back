<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Service\EtapeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/etape')]
class EtapeController extends AbstractController
{
    private SerializerInterface $serializer;
    private EtapeService $EtapeService;

    public function __construct(EtapeService $EtapeService, SerializerInterface $serializer)
    {
        $this->EtapeService = $EtapeService;
        $this->serializer = $serializer;
    }

    #[Route('/', methods: ['GET'])]
    public function getAll(): Response
    {
        $etape = $this->EtapeService->getAll();
        $data = $this->serializer->serialize($etape, 'json', ['groups' => 'getEtape']);
        return new Response($data);
    }
    #[Route('/{id}')]
    public function get($id): Response
    {
        $etape = $this->EtapeService->get($id);
        $data = $this->serializer->serialize($etape, 'json', ['groups' => 'getEtape']);
        return new Response($data);
    }

    #[Route('/', methods: ['POST'])]
    public function create(#[MapRequestPayload()] Etape $etape): Response
    {
        $etape = $this->EtapeService->create($etape);
        $data = $this->serializer->serialize($etape, 'json');
        return new Response($data);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function put(Etape $newIngredient, $id): Response
    {
        $etape = $this->EtapeService->update($newIngredient, $id);
        return new Response($etape);
    }
}
