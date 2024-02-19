<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $couverture = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Admin::class, inversedBy: 'livres')]
    private Collection $auteur;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'livres', targetEntity: AchatUrl::class, cascade: ['remove'])]
    private Collection $achatUrls;

    #[ORM\ManyToMany(targetEntity: CatLivre::class, inversedBy: 'livres')]
    private Collection $genre;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $shortDescription = null;

    #[ORM\Column]
    private ?int $nbrPage = null;

    public function __construct()
    {
        $this->auteur = new ArrayCollection();
        $this->achatUrls = new ArrayCollection();
        $this->genre = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouverture(): ?string
    {
        return $this->couverture;
    }

    public function setCouverture(string $couverture): static
    {
        $this->couverture = $couverture;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Admin>
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(Admin $auteur): static
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur->add($auteur);
        }

        return $this;
    }

    public function removeAuteur(Admin $auteur): static
    {
        $this->auteur->removeElement($auteur);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, AchatUrl>
     */
    public function getAchatUrls(): Collection
    {
        return $this->achatUrls;
    }

    public function addAchatUrl(AchatUrl $achatUrl): static
    {
        if (!$this->achatUrls->contains($achatUrl)) {
            $this->achatUrls->add($achatUrl);
            $achatUrl->setLivres($this);
        }

        return $this;
    }

    public function removeAchatUrl(AchatUrl $achatUrl): static
    {
        if ($this->achatUrls->removeElement($achatUrl)) {
            // set the owning side to null (unless already changed)
            if ($achatUrl->getLivres() === $this) {
                $achatUrl->setLivres(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CatLivre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(CatLivre $genre): static
    {
        if (!$this->genre->contains($genre)) {
            $this->genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(CatLivre $genre): static
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getNbrPage(): ?int
    {
        return $this->nbrPage;
    }

    public function setNbrPage(int $nbrPage): static
    {
        $this->nbrPage = $nbrPage;

        return $this;
    }
}
