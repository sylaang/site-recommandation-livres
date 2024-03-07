<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CustomTwigExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('glob', [$this, 'glob']),
        ];
    }

    public function glob(string $pattern): array
    {
        return glob($pattern);
    }
}