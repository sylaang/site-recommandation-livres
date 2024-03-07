<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Services\MailService;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $livreRepository;
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager, MailService $mailService): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        $adminInfos = $this->adminRepository->findAdminInfos();


        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $context = [
                'contact' => $contact,
            ];


            $mailService->sendMail(
                'contact@philippepopieul.fr',
                'contact@philippepopieul.fr',
                $contact->getSubject(),
                'contact',
                $context,
                $contact->getMail()
            );
            $this->addFlash(
                'succes',
                'Votre message a été envoyé avec succès !'
            );
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
            'adminInfos' => $adminInfos,
        ]);
    }
}
