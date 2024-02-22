<?php

namespace App\Controller;

use App\Repository\AdminRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AproposController extends AbstractController
{

    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    #[Route('/apropos', name: 'app_apropos')]
    public function index(): Response
    {
        $adminInfos = $this->adminRepository->findAdminInfos();

        return $this->render('apropos/index.html.twig', [
            'adminInfos' => $adminInfos,
        ]);
    }
}
