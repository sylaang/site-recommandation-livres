<?php

namespace App\Twig;

use App\Entity\Admin;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class SloganExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions() : array
    {
        return [
            new TwigFunction('slogan', [$this, 'getSlogan'])
        ];
    }

    public function getSlogan(): ?string
    {
        $admin = $this->em->getRepository(Admin::class)->findOneBy([], ['slogan' => 'ASC']);
        return $admin ? $admin->getSlogan() : null;
    }
}