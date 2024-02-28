<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Admin implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Livre::class, mappedBy: 'auteur')]
    private Collection $livres;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Biographie = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $shortBiographie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageBiographie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondImageBiographie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageReseauxSociaux = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstimageHome = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgShortBiographie = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $slogan = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgLogo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgLogoTrans = null;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): static
    {
        if (!$this->livres->contains($livre)) {
            $this->livres->add($livre);
            $livre->addAuteur($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        if ($this->livres->removeElement($livre)) {
            $livre->removeAuteur($this);
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->Biographie;
    }

    public function setBiographie(string $Biographie): static
    {
        $this->Biographie = $Biographie;

        return $this;
    }

    public function getShortBiographie(): ?string
    {
        return $this->shortBiographie;
    }

    public function setShortBiographie(string $shortBiographie): static
    {
        $this->shortBiographie = $shortBiographie;

        return $this;
    }

    public function getImageBiographie(): ?string
    {
        return $this->imageBiographie;
    }

    public function setImageBiographie(string $imageBiographie): static
    {
        $this->imageBiographie = $imageBiographie;

        return $this;
    }

    public function getSecondImageBiographie(): ?string
    {
        return $this->secondImageBiographie;
    }

    public function setSecondImageBiographie(?string $secondImageBiographie): static
    {
        $this->secondImageBiographie = $secondImageBiographie;

        return $this;
    }

    public function getImageReseauxSociaux(): ?string
    {
        return $this->imageReseauxSociaux;
    }

    public function setImageReseauxSociaux(?string $imageReseauxSociaux): static
    {
        $this->imageReseauxSociaux = $imageReseauxSociaux;

        return $this;
    }

    public function getFirstimageHome(): ?string
    {
        return $this->firstimageHome;
    }

    public function setFirstimageHome(?string $firstimageHome): static
    {
        $this->firstimageHome = $firstimageHome;

        return $this;
    }

    public function getImgShortBiographie(): ?string
    {
        return $this->imgShortBiographie;
    }

    public function setImgShortBiographie(?string $imgShortBiographie): static
    {
        $this->imgShortBiographie = $imgShortBiographie;

        return $this;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(?string $slogan): static
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getImgLogo(): ?string
    {
        return $this->imgLogo;
    }

    public function setImgLogo(?string $imgLogo): static
    {
        $this->imgLogo = $imgLogo;

        return $this;
    }

    public function getImgLogoTrans(): ?string
    {
        return $this->imgLogoTrans;
    }

    public function setImgLogoTrans(?string $imgLogoTrans): static
    {
        $this->imgLogoTrans = $imgLogoTrans;

        return $this;
    }
}
