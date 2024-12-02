<?php

namespace App\Manager;

use App\Entity\VerMasTarde;
use App\Entity\Usuario;
use App\Entity\Pelicula;
use App\Entity\Serie;
use Doctrine\ORM\EntityManagerInterface;

class VerMasTardeManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function agregarVerMasTarde(Usuario $usuario, $peliculaId = null, $serieId = null)
    {
        $verMasTarde = new VerMasTarde();
        $verMasTarde->setUsuario($usuario);

        if ($peliculaId) {
            $pelicula = $this->entityManager->getRepository(Pelicula::class)->find($peliculaId);
            $verMasTarde->setPelicula($pelicula);
        }

        if ($serieId) {
            $serie = $this->entityManager->getRepository(Serie::class)->find($serieId);
            $verMasTarde->setSerie($serie);
        }

        $verMasTarde->setFechaAgregado(new \DateTime());
        $this->entityManager->persist($verMasTarde);
        $this->entityManager->flush();
    }

    public function eliminarVerMasTarde(Usuario $usuario, $peliculaId = null, $serieId = null)
    {
        $verMasTarde = $this->entityManager->getRepository(VerMasTarde::class)
            ->findOneBy(['usuario' => $usuario, 'pelicula' => $peliculaId, 'serie' => $serieId]);

        if ($verMasTarde) {
            $this->entityManager->remove($verMasTarde);
            $this->entityManager->flush();
        }
    }

    public function obtenerVerMasTarde(Usuario $usuario)
    {
        return $this->entityManager->getRepository(VerMasTarde::class)->findBy(['usuario' => $usuario]);
    }
}
