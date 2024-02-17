<?php

namespace App\Controller;

use App\Entity\CatLivre;
use App\Form\CatLivreType;
use App\Repository\CatLivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/cat/livre')]
class AdminCatLivreController extends AbstractController
{
    #[Route('/', name: 'app_admin_cat_livre_index', methods: ['GET'])]
    public function index(CatLivreRepository $catLivreRepository): Response
    {
        return $this->render('admin_cat_livre/index.html.twig', [
            'cat_livres' => $catLivreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_cat_livre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $catLivre = new CatLivre();
        $form = $this->createForm(CatLivreType::class, $catLivre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($catLivre);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_cat_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_cat_livre/new.html.twig', [
            'cat_livre' => $catLivre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cat_livre_show', methods: ['GET'])]
    public function show(CatLivre $catLivre): Response
    {
        return $this->render('admin_cat_livre/show.html.twig', [
            'cat_livre' => $catLivre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_cat_livre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CatLivre $catLivre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CatLivreType::class, $catLivre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_cat_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_cat_livre/edit.html.twig', [
            'cat_livre' => $catLivre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cat_livre_delete', methods: ['POST'])]
    public function delete(Request $request, CatLivre $catLivre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$catLivre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($catLivre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_cat_livre_index', [], Response::HTTP_SEE_OTHER);
    }
}
