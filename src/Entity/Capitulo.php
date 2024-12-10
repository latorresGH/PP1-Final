<?php

namespace App\Entity;

use App\Repository\CapituloRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapituloRepository::class)]
class Capitulo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $titulo;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: 'capitulos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Serie $serie;

    #[ORM\Column(type: 'string', length: 255)]
    private string $archivo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;
        return $this;
    }

    public function getArchivo(): string
    {
        return $this->archivo;
    }

    public function setArchivo(string $archivo): self
    {
        $this->archivo = $archivo;
        return $this;
    }

}
