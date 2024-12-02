<?php

namespace App\Entity;

use App\Repository\VerMasTardeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VerMasTardeRepository::class)]
class VerMasTarde
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'verMasTardes', cascade: ['persist'], fetch: 'LAZY')]
    private ?Usuario $usuario = null;
    
    #[ORM\ManyToOne(targetEntity: Pelicula::class, inversedBy: 'verMasTardes', fetch: 'LAZY', cascade: ['persist'])]
    private ?Pelicula $pelicula = null;
    
    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: 'verMasTardes', fetch: 'LAZY', cascade: ['persist'])]
    private ?Serie $serie = null;
    

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaAgregado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getPelicula(): ?Pelicula
    {
        return $this->pelicula;
    }

    public function setPelicula(?Pelicula $pelicula): static
    {
        $this->pelicula = $pelicula;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getFechaAgregado(): ?\DateTimeInterface
    {
        return $this->fechaAgregado;
    }

    public function setFechaAgregado(\DateTimeInterface $fechaAgregado): static
    {
        $this->fechaAgregado = $fechaAgregado;

        return $this;
    }
}
