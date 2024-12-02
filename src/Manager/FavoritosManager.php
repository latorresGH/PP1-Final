<?php

namespace App\Manager;

use App\Entity\Favorito;
use App\Entity\Usuario;
use App\Entity\Pelicula;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;


class FavoritosManager
{
    private $entityManager;
    // private $logger;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        // $this->logger = $logger;
    }

    public function agregarFavorito(Usuario $usuario, $peliculaId)
    {
        $favorito = new Favorito();
        $favorito->setUsuario($usuario);

        if ($peliculaId) {
            $pelicula = $this->entityManager->getRepository(Pelicula::class)->find($peliculaId);
            $favorito->setPelicula($pelicula);
        }
        
        $favorito->setFechaAgregado(new \DateTime());

        $this->entityManager->persist($favorito);
        $this->entityManager->flush();
    }

    public function eliminarFavorito(int $id): Response
    {
        // Buscar el favorito por su ID directamente en el EntityManager
        $favorito = $this->entityManager->getRepository(Favorito::class)->find($id);
    
        if (!$favorito) {
            // Si no se encuentra el favorito, retornamos un error
            return new Response('Favorito no encontrado', Response::HTTP_NOT_FOUND);
        }
    
        // Eliminar solo el favorito (sin eliminar el usuario asociado)
        $this->entityManager->remove($favorito);
        $this->entityManager->flush();
    
        return new Response('Favorito eliminado con éxito', Response::HTTP_OK);
    }
    
    

    public function obtenerFavoritos(Usuario $usuario)
    {
        return $this->entityManager->getRepository(Favorito::class)->findBy(['usuario' => $usuario]);
    }
}
