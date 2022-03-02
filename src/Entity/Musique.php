<?php

namespace App\Entity;

use App\Repository\MusiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MusiqueRepository::class)
 */
class Musique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_visionnage;

    /**
     * @ORM\ManyToOne(targetEntity=Artiste::class, inversedBy="musiques")
     */
    private $artiste;

    /**
     * @ORM\ManyToOne(targetEntity=Album::class, inversedBy="musiques")
     */
    private $album;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="musiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lienYT;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="musiques")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbVisionnage(): ?int
    {
        return $this->nb_visionnage;
    }

    public function setNbVisionnage(?int $nb_visionnage): self
    {
        $this->nb_visionnage = $nb_visionnage;

        return $this;
    }

    public function getArtiste(): ?artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getAlbum(): ?album
    {
        return $this->album;
    }

    public function setAlbum(?album $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getGenre(): ?genre
    {
        return $this->genre;
    }

    public function setGenre(?genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getLienYT(): ?string
    {
        return $this->lienYT;
    }

    public function setLienYT(string $lienYT): self
    {
        $this->lienYT = $lienYT;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addMusique($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeMusique($this);
        }

        return $this;
    }
}
