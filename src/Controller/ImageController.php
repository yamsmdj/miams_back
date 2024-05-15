<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{

    #[Route("/upload-image", methods: ['POST'])]
    public function uploadImage(Request $request): Response
    {
        $base64Image = $request->request->get('image');

        if ($base64Image) {
            // Convertir la chaîne base64 en données binaires
            $imageData = base64_decode($base64Image);

            // Générer un nom de fichier unique
            $fileName = "recettes" . uniqid() . '.png';

            // Chemin du répertoire de destination
            $destinationDirectory = $this->getParameter('kernel.project_dir') . '/public/assets/recettes/' ;

            // Créer le répertoire s'il n'existe pas
            if (!file_exists($destinationDirectory)) {
                mkdir($destinationDirectory, 0777, true);
            }

            // Chemin complet du fichier de destination
            $destinationPath = $destinationDirectory . DIRECTORY_SEPARATOR . $fileName;

            // Enregistrer l'image dans le dossier public
            if (file_put_contents($destinationPath, $imageData)) {
                // Retourner une réponse avec le chemin de l'image enregistrée
                return new Response($fileName, Response::HTTP_CREATED);
            } else {
                // Gérer l'échec de l'enregistrement du fichier
                return new Response('Erreur lors de l\'enregistrement de l\'image', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            // Retourner une réponse avec un message d'erreur si aucune image n'est fournie
            return new Response('Aucune image fournie', Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/assets/recettes/{path}', methods: ['GET'])]
    public function getImage(string $path): Response
    {
        $filePath = $this->getParameter('kernel.project_dir') . '/public/assets/recettes/' . $path;
    
        // Vérifier si le fichier existe
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return new Response('Fichier non trouvé ptit', 404);
        }
    
        // Récupérer le type MIME de l'image
        $mimeType = mime_content_type($filePath);
    
        // Lire le contenu du fichier
        $content = file_get_contents($filePath);
    
        // Créer une réponse avec le contenu et le type MIME
        $response = new Response($content);
        $response->headers->set('Content-Type', $mimeType);
    
        // Retourner la réponse construite
        return $response;
    }
    
}




    // #[Route("/upload-image", methods: ['POST'])]
    // public function uploadImage(Request $request): Response
    // {
    //     $uploadedFile = $request->files->get('image');
    //     // $path = "/assets/recettes/" . $uploadedFile;

    //     if (!$uploadedFile) {
    //         return new Response('No image uploaded', Response::HTTP_BAD_REQUEST);
    //     }

    //     $destination = $this->getParameter('images_directory');

    //     try {
    //         $uploadedFile->move($destination, $uploadedFile->getClientOriginalName());
    //         return new Response('Image uploaded successfully', Response::HTTP_OK);
    //     } catch (\Exception $e) {
    //         return new Response('Failed to upload image', Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }
