<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
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

    #[ORM\Column]
    private ?int $temporadas = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\Column(length: 255)]
    private ?string $archivo = null;
    
    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private ?int $vistas = 0;

    #[ORM\Column]
    private ?int $contadorFavorito = 0;

    /**
     * @var Collection<int, Favorito>
     */
    #[ORM\OneToMany(targetEntity: Favorito::class, mappedBy: 'serie')]
    private Collection $favoritos;

    /**
     * @var Collection<int, VerMasTarde>
     */
    #[ORM\OneToMany(targetEntity: VerMasTarde::class, mappedBy: 'serie')]
    private Collection $verMasTardes;


    #[ORM\OneToMany(mappedBy: 'serie', targetEntity: Capitulo::class)]
    private $capitulos;

    public function __construct()
    {
        $this->favoritos = new ArrayCollection();
        $this->verMasTardes = new ArrayCollection();
        $this->capitulos = new ArrayCollection();
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

    public function getTemporadas(): ?int
    {
        return $this->temporadas;
    }

    public function setTemporadas(int $temporadas): static
    {
        $this->temporadas = $temporadas;

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

    public function getContadorFavorito(): ?int
    {
        return $this->contadorFavorito;
    }

    public function setContadorFavorito(int $contadorFavorito): static
    {
        $this->contadorFavorito = $contadorFavorito;

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
            $favorito->setSerie($this);

            $this->contadorFavorito++;
        }

        return $this;
    }

    public function removeFavorito(Favorito $favorito): static
    {
        if ($this->favoritos->removeElement($favorito)) {
            // set the owning side to null (unless already changed)
            if ($favorito->getSerie() === $this) {
                $favorito->setSerie(null);

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
            $verMasTarde->setSerie($this);
        }

        return $this;
    }

    public function removeVerMasTarde(VerMasTarde $verMasTarde): static
    {
        if ($this->verMasTardes->removeElement($verMasTarde)) {
            // set the owning side to null (unless already changed)
            if ($verMasTarde->getSerie() === $this) {
                $verMasTarde->setSerie(null);
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

    public function getCapitulos(): Collection
    {
        return $this->capitulos;
    }

}
