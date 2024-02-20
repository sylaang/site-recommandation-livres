<?php

namespace App\Controller;

use App\Entity\Livre;
use Twig\Environment;
use App\Repository\AdminRepository;
use App\Repository\LivreRepository;
use App\Utils\extractDomainFromUrl;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/livre')]
class LivreController extends AbstractController
{

    private $adminRepository;
    private $livreRepository;

    public function __construct( AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    #[Route('/', name: 'app_livre_index', methods: ['GET'])]
    public function index(LivreRepository $livreRepository): Response
    {

        $adminInfos = $this->adminRepository->findAdminInfos();

        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
            'adminInfos' => $adminInfos,
        ]);
    }

    #[Route('/{id}', name: 'app_livre_show', methods: ['GET'])]
    public function show(Livre $livre, Environment $twig): Response
    {

        $twig->addFilter(new \Twig\TwigFilter('extractDomainFromUrl', [extractDomainFromUrl::class, 'extractDomainFromUrl']));

        $adminInfos = $this->adminRepository->findAdminInfos();
        
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
            'adminInfos' => $adminInfos,

        ]);
    }
}
