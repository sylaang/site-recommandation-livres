<?php

namespace App\Controller;

use DateTime;
use App\Entity\Admin;
use DateTimeImmutable;
use App\Form\AdminType;
use App\Services\FileUploader;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/auteurs', name: 'app_admin_index', methods: ['GET'])]
    public function index(AdminRepository $adminRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'admins' => $adminRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_admin_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    // {
    //     $admin = new Admin();
        
    //     $form = $this->createForm(AdminType::class, $admin);
    //     $form->handleRequest($request);
        
    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $imagename = $form->get('imageBiographie')->getData();

    //         if ($imagename) {

    //             $imageBiographie_nom = $fileUploader->uploadBiographie($imagename, $admin);               
                
    //             $admin->setImageBiographie($imageBiographie_nom);
    //         }

    //         $admin->setCreatedAt(new DateTimeImmutable());
    //         $admin->setUpdatedAt(new DateTimeImmutable());
    //         $entityManager->persist($admin);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('admin/new.html.twig', [
    //         'admin' => $admin,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/profil', name: 'app_admin_show', methods: ['GET'])]
    public function show(): Response
    {
        $admin = $this->getUser();
        return $this->render('admin/show.html.twig', [
            'admin' => $admin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Admin $admin, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imagename = $form->get('imageBiographie')->getData();
            $imagename2 = $form->get('secondImageBiographie')->getData();
            $imagename3 = $form->get('imageReseauxSociaux')->getData();
            $imagename4 = $form->get('firstImageHome')->getData();
            $imagename5 = $form->get('ImgShortBiographie')->getData();
            $imagename6 = $form->get('imgLogo')->getData();
            $imagename7 = $form->get('imgLogoTrans')->getData();

            if ($imagename) {

                $imageBiographie_nom = $fileUploader->uploadBiographie($imagename, $admin);                
                
                $admin->setimageBiographie($imageBiographie_nom);
            }
            if ($imagename2) {

                $secondImageBiographie_nom = $fileUploader->uploadSecondBiographie($imagename2, $admin);                
                
                $admin->setSecondImageBiographie($secondImageBiographie_nom);
            }
            if ($imagename3) {

                $imageReseauxSociaux_nom = $fileUploader->uploadThirdBiographie($imagename3, $admin);                
                
                $admin->setImageReseauxSociaux($imageReseauxSociaux_nom);
            }
            if ($imagename4) {

                $firstImageHome_nom = $fileUploader->uploadFirstImageHome($imagename4, $admin);                
                
                $admin->setFirstImageHome($firstImageHome_nom);
            }
            if ($imagename5) {

                $ImgShortBiographie_nom = $fileUploader->uploadImgShortBiographie($imagename5, $admin);                
                
                $admin->setImgShortBiographie($ImgShortBiographie_nom);
            }
            if ($imagename6) {

                $ImgLogo_nom = $fileUploader->uploadImgLogo($imagename6, $admin);                
                
                $admin->setImgLogo($ImgLogo_nom);
            }
            if ($imagename7) {

                $ImgLogoTrans_nom = $fileUploader->uploadImgLogoTrans($imagename7, $admin);                
                
                $admin->setImgLogoTrans($ImgLogoTrans_nom);
            }

            $admin->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/edit.html.twig', [
            'admin' => $admin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Admin $admin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$admin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($admin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
