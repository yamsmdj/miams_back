<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/user')]
class UserController extends AbstractController
{
    private UserService $userService;
    private SerializerInterface $serializer;
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserService $userService, SerializerInterface $serializer, UserPasswordHasherInterface $hasher)
    {
        $this->serializer = $serializer;
        $this->userService = $userService;
        $this->hasher = $hasher;
    }

    #[Route('/', methods: ['GET'])]
    public function getAll(): Response
    {
        $user = $this->userService->getAll();
        $data = $this->serializer->serialize($user, 'json');
        return new Response($data);
    }
    #[Route('/{id}', methods: ['GET'])]
    public function get($id): Response
    {

        $recette = $this->userService->get($id);
        $data = $this->serializer->serialize($recette, 'json');

        return new Response($data);
    }
    #[Route('/', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $userData = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        $createdUser = $this->userService->create($userData);
        return new Response($this->serializer->serialize($createdUser, 'json'));
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function put(#[MapRequestPayload()] User $newUser, $id): Response
    {
        $user = $this->userService->update($newUser, $id);
        return new Response($user);
    }
    #[Route('/{id}', methods: ['PATCH'])]
    public function patch($id, #[MapRequestPayload()] User $user):Response
    {
        $user = $this->userService->patch($id, $user);
        return new Response ($user);
    }

    #[Route('/login', methods: ['POST'])]
    public function login(Request $request, JwtEncoderInterface $jwtEncoder): JsonResponse
    {
        // Récupérer les données du corps de la requête
        $jsonData = json_decode($request->getContent(), true);

        $username = $jsonData['username'];
        $password = $jsonData['password'];

        $user = $this->userService->findByUsername($username);
        if (!$user || !$this->hasher->isPasswordValid($user, $password)) {

            return new JsonResponse(['message' => 'Email ou mot de passe incorrect.'], Response::HTTP_UNAUTHORIZED);
        }
        $roles = $user->getRoles();
        // Générer le token JWT
        $token = $jwtEncoder->encode(['id' => $user->getId(), 'username' => $user->getUsername(),'roles' => $roles]);
        $response = new JsonResponse(['token' => $token]);


        return $response;
    }
}
