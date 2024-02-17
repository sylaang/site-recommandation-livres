<?php

namespace App\Controller;

use App\Utils\extractDomainFromUrl;
use Twig\Environment;
use App\Repository\AdminRepository;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $livreRepository;
    private $adminRepository;

    public function __construct(LivreRepository $livreRepository, AdminRepository $adminRepository)
    {
        $this->livreRepository = $livreRepository;
        $this->adminRepository = $adminRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request, Environment $twig): Response
    {
        
        $livres = $this->livreRepository->findAllWithUrlsAndImages();

        $adminInfos = $this->adminRepository->findAdminInfos();

        $twig->addFilter(new \Twig\TwigFilter('extractDomainFromUrl', [extractDomainFromUrl::class, 'extractDomainFromUrl']));

        return $this->render('home/index.html.twig', [
            'livres' => $livres,
            'adminInfos' => $adminInfos,
        ]);
    }
}