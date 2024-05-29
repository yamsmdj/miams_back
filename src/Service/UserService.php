<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{

    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $hasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher)
    {
        $this->em = $em;
        $this->hasher = $hasher;
    }
    public function create(User $user)
    {

        $newUser = new User();
        $newUser->setEmail($user->getEmail());
        $newUser->setRoles(["ROLE_USER"]);
        $newUser->setPassword($this->hasher->hashPassword($newUser, $user->getPassword()));

        $this->em->persist($newUser);
        $this->em->flush();
        return $newUser;
    }
    public function getAll()
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function get($id)
    {
        return $this->em->getRepository(User::class)->find($id);
    }



    public function findByUsername($username): ?User
    {
        return $this->em->getRepository(User::class)->findOneBy(['email' => $username]);
    }

    public function update(User $user, $id): string
    {
        $existingUser = $this->em->getRepository(User::class)->find($id);
        if ($existingUser) {
            $existingUser->setEmail($user->getEmail() ?? $existingUser->getEmail());
            $hashedPassword = $this->hasher->hashPassword($existingUser, $user->getPassword());
            $existingUser->setPassword($hashedPassword);
            $existingUser->setRoles($user->getRoles() ?? $existingUser->getRoles());
            $this->em->flush();
            return "Le user possedant l'id {$id} a été mis a jour avec succès !";
        } else {
            return "Le user avec l'id {$id} n'a pas pu se mettre a jour.";
        }
    }
        public function patch(int $id, User $user): string
        {
            $existingUser = $this->em->getRepository(User::class)->find($id);
        
            if ($existingUser) {
                if ($user->getEmail() !== null) {
                    $existingUser->setEmail($user->getEmail());
                }
        
                // Mise à jour du mot de passe si fourni
                if ($user->getPassword() !== null) {
                    $hashedPassword = $this->hasher->hashPassword($existingUser, $user->getPassword());
                    $existingUser->setPassword($hashedPassword);
                }
        
                // Debugging: Affichage des données de l'utilisateur modifié
                var_dump($existingUser);
        
                $this->em->persist($existingUser);
                $this->em->flush();
        
                return "L'utilisateur avec l'ID {$id} a été mis à jour avec succès !";
            } else {
                return "L'utilisateur avec l'ID {$id} n'existe pas.";
            }
        }
        

    public function delete(User $user): void
    {
        try {
            $this->em->remove($user);
            $this->em->flush();
        } catch (Exception $e) {
            throw new Exception("Aucun ingredient avec l'id" . $user->getId() . "n'a été trouvé.");
        }
    }
}
