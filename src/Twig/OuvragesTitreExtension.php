<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;
use Twig\TwigFunction;
use App\Entity\Livre;

class OuvragesTitreExtension extends AbstractExtension 
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions() : array
    {
        return [
            new TwigFunction('titres', [$this, 'getTitres'])
        ];
    }

    public function getTitres()
    {
        return $this->em->getRepository(Livre::class)->findBy([], ['titre' => 'ASC']);
    }
}