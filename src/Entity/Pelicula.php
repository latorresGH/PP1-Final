<?php

namespace App\Entity;

use App\Repository\PeliculaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeliculaRepository::class)]
class Pelicula
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?int $duracion = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\Column(length: 255)]
    private ?string $archivo = null;

    /**
     * @var Collection<int, Favorito>
     */
    #[ORM\OneToMany(targetEntity: Favorito::class, mappedBy: 'pelicula')]
    private Collection $favoritos;

    /**
     * @var Collection<int, VerMasTarde>
     */
    #[ORM\OneToMany(targetEntity: VerMasTarde::class, mappedBy: 'pelicula')]
    private Collection $verMasTardes;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private ?int $vistas = 0;

    #[ORM\Column]
    private ?int $contadorFavorito = 0;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $portada = null;

    public function __construct()
    {
        $this->favoritos = new ArrayCollection();
        $this->verMasTardes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): static
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getArchivo(): ?string
    {
        return $this->archivo;
    }

    public function setArchivo(string $archivo): static
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * @return Collection<int, Favorito>
     */
    public function getFavoritos(): Collection
    {
        return $this->favoritos;
    }

    public function addFavorito(Favorito $favorito): static
    {
        if (!$this->favoritos->contains($favorito)) {
            $this->favoritos->add($favorito);
            $favorito->setPelicula($this);

            $this->contadorFavorito++;
        }

        return $this;
    }

    public function removeFavorito(Favorito $favorito): static
    {
        if ($this->favoritos->removeElement($favorito)) {
            // set the owning side to null (unless already changed)
            if ($favorito->getPelicula() === $this) {
                $favorito->setPelicula(null);

                $this->contadorFavorito--;
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VerMasTarde>
     */
    public function getVerMasTardes(): Collection
    {
        return $this->verMasTardes;
    }

    public function addVerMasTarde(VerMasTarde $verMasTarde): static
    {
        if (!$this->verMasTardes->contains($verMasTarde)) {
            $this->verMasTardes->add($verMasTarde);
            $verMasTarde->setPelicula($this);
        }

        return $this;
    }

    public function removeVerMasTarde(VerMasTarde $verMasTarde): static
    {
        if ($this->verMasTardes->removeElement($verMasTarde)) {
            // set the owning side to null (unless already changed)
            if ($verMasTarde->getPelicula() === $this) {
                $verMasTarde->setPelicula(null);
            }
        }

        return $this;
    }

    public function getVistas(): ?int
    {
        return $this->vistas;
    }

    public function setVistas(int $vistas): self
    {
        $this->vistas = $vistas;

        return $this;
    }

    public function incrementarVista(): self
    {
        $this->vistas++;
        return $this;
    }

    public function getContadorFavorito(): ?int
    {
        return $this->contadorFavorito;
    }

    public function setContadorFavorito(int $contadorFavorito): static
    {
        $this->contadorFavorito = $contadorFavorito;

        return $this;
    }

    public function getPortada(): ?string
    {
        return $this->portada;
    }

    public function setPortada(?string $portada): static
    {
        $this->portada = $portada;

        return $this;
    }
}
