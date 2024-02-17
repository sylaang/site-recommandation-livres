<?php

namespace App\Entity;

use App\Repository\AchatUrlRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatUrlRepository::class)]
class AchatUrl
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'achatUrls')]
    private ?Livre $livres = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivres(): ?Livre
    {
        return $this->livres;
    }

    public function setLivres(?Livre $livres): static
    {
        $this->livres = $livres;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
