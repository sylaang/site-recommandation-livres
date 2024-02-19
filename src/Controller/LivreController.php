<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\Livre1Type;
use App\Repository\AdminRepository;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/livre')]
class LivreController extends AbstractController
{

    private $adminRepository;

    public function __construct(LivreRepository $livreRepository, AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    #[Route('/', name: 'app_livre_index', methods: ['GET'])]
    public function index(LivreRepository $livreRepository, AdminRepository $adminRepository): Response
    {

        $adminInfos = $this->adminRepository->findAdminInfos();

        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
            'adminInfos' => $adminInfos,
        ]);
    }

    #[Route('/{id}', name: 'app_livre_show', methods: ['GET'])]
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }
}
