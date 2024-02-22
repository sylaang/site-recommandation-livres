<?php

namespace App\Controller;

use App\Utils\extractDomainFromUrl;
use App\Entity\Livre;
use Twig\Environment;
use DateTimeImmutable;
use App\Form\LivreType;
use App\Entity\AchatUrl;
use App\Services\FileUploader;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/livre')]
class AdminLivreController extends AbstractController
{
    #[Route('/', name: 'app_admin_livre_index', methods: ['GET'])]
    public function index(Environment $twig, LivreRepository $livreRepository): Response
    {
        // ...
        
        // Enregistrer la fonction extractDomainFromUrl comme filtre personnalisé dans l'environnement Twig
        $twig->addFilter(new \Twig\TwigFilter('extractDomainFromUrl', [extractDomainFromUrl::class, 'extractDomainFromUrl']));
        
        return $this->render('admin_livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
            // ...
        ]);
    }

    #[Route('/new', name: 'app_admin_livre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imagename = $form->get('couverture')->getData();
            $liens = $form->get('achatUrls')->getData();

            if ($imagename) {

                $imageCouverture_nom = $fileUploader->uploadLivre($imagename, $livre);                
                
                $livre->setCouverture($imageCouverture_nom);
            }
            
            
            foreach ($liens as $achatUrl) {
                if ($achatUrl instanceof AchatUrl) {
                    $url = $achatUrl->getUrl();
                    
                    // $newAchatUrl = new AchatUrl();
                    $newAchatUrl = $achatUrl->setLivres($livre);
                    $newAchatUrl->setUrl($url);
                    
                    $entityManager->persist($newAchatUrl);
                    $entityManager->persist($achatUrl);
                }
            }
            $livre->setCreatedAt(new DateTimeImmutable());
            $livre->setUpdatedAt(new DateTimeImmutable());
            
            
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_livre_show', methods: ['GET'])]
    public function show(Livre $livre): Response
    {
        return $this->render('admin_livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_admin_livre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livre $livre, EntityManagerInterface $entityManager, FileUploader $fileUploader ): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
        

       
        if ($form->isSubmitted() && $form->isValid()) {

            $imagename = $form->get('couverture')->getData();
            $liens = $form->get('achatUrls')->getData();

            if ($imagename) {

                $imageCouverture_nom = $fileUploader->uploadLivre($imagename, $livre);                
                
                $livre->setCouverture($imageCouverture_nom);
            }
            
            
            foreach ($liens as $achatUrl) {
                if ($achatUrl instanceof AchatUrl) {
                    $url = $achatUrl->getUrl();
                    
                    // $newAchatUrl = new AchatUrl();
                    $newAchatUrl = $achatUrl->setLivres($livre);
                    $newAchatUrl->setUrl($url);
                    
                    $entityManager->persist($newAchatUrl);
                    $entityManager->persist($achatUrl);
                }
            }
            $livre->setUpdatedAt(new DateTimeImmutable());
            
            
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_livre_index', [], Response::HTTP_SEE_OTHER);
        }
        

        return $this->renderForm('admin_livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_livre_delete', methods: ['POST'])]
    public function delete(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_livre_index', [], Response::HTTP_SEE_OTHER);
    }
}
