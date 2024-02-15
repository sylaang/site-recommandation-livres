<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        // Récupérer la largeur de l'écran à partir de la requête
        $screenWidth = $request->query->get('screenWidth', 0);

        return $this->render('home/index.html.twig', [
            'screen_width' => $screenWidth,
        ]);
    }
}