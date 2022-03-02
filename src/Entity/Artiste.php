<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtisteRepository::class)
 */
class Artiste
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Album::class, mappedBy="artistes")
     */
    private $albums;

    /**
     * @ORM\OneToMany(targetEntity=Musique::class, mappedBy="artiste")
     */
    private $musiques;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienWK;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->musiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Album[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setArtistes($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getArtistes() === $this) {
                $album->setArtistes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Musique[]
     */
    public function getMusiques(): Collection
    {
        return $this->musiques;
    }

    public function addMusique(Musique $musique): self
    {
        if (!$this->musiques->contains($musique)) {
            $this->musiques[] = $musique;
            $musique->setArtiste($this);
        }

        return $this;
    }

    public function removeMusique(Musique $musique): self
    {
        if ($this->musiques->removeElement($musique)) {
            // set the owning side to null (unless already changed)
            if ($musique->getArtiste() === $this) {
                $musique->setArtiste(null);
            }
        }

        return $this;
    }
public function __toString()
    {
        return $this->nom;
    }

public function getLienWK(): ?string
{
    return $this->lienWK;
}

public function setLienWK(?string $lienWK): self
{
    $this->lienWK = $lienWK;

    return $this;
}
}
