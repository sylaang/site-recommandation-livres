<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PolitiqueConfController extends AbstractController
{
    #[Route('/politique-de-confidentialite', name: 'app_politique_conf')]
    public function index(): Response
    {
        return $this->render('politique_conf/index.html.twig', [
            'controller_name' => 'PolitiqueConfController',
        ]);
    }
}
