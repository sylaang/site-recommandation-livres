<?php

namespace App\Services;


use App\Repository\LivreRepository;

class LivreService
{
    private $bookRepository;

    public function __construct(LivreRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBookTitles()
    {
        // Récupérer tous les titres des livres depuis le repository des livres
        $books = $this->bookRepository->findAll();

        // Extraire les titres des livres
        $titles = [];
        foreach ($books as $book) {
            $titles[] = $book->getTitre();
        }

        return $titles;
    }
}