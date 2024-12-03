<?php

namespace App\Manager;

use App\Entity\Favorito;
use App\Entity\Usuario;
use App\Entity\Pelicula;
use App\Entity\Serie;
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

    public function agregarFavorito(Usuario $usuario, $peliculaId, $serieId)
    {
        $favorito = new Favorito();
        $favorito->setUsuario($usuario);
    
        if ($peliculaId) {
            $pelicula = $this->entityManager->getRepository(Pelicula::class)->find($peliculaId);
            $favorito->setPelicula($pelicula);
            // Aquí agregamos el favorito a la película
            $pelicula->addFavorito($favorito);  // Asegúrate de llamar a addFavorito de la entidad
        }

        if ($serieId) {
            $serie = $this->entityManager->getRepository(Serie::class)->find($serieId);
            if ($serie) {
                $favorito->setSerie($serie); // Asumiendo que tienes este método en Favorito
            }
        }//VEREMOS DE DEJARLO O SACARLO
        
        $favorito->setFechaAgregado(new \DateTime());

        $this->entityManager->persist($favorito);
        $this->entityManager->flush();
    }
    

    public function eliminarFavorito(int $id): Response
    {
        // Buscar el favorito por su ID
        $favorito = $this->entityManager->getRepository(Favorito::class)->find($id);
        
        if (!$favorito) {
            // Si no se encuentra el favorito, retornamos un error
            return new Response('Favorito no encontrado', Response::HTTP_NOT_FOUND);
        }
    
        // Obtener la película asociada al favorito
        $pelicula = $favorito->getPelicula();
        
        // Si existe una película asociada, decrementamos el contador
        if ($pelicula) {
            $pelicula->removeFavorito($favorito);
            $pelicula->removeFavorito($favorito);
        }
    
        // Eliminar el favorito
        $this->entityManager->remove($favorito);
        $this->entityManager->flush();
        
        return new Response('Favorito eliminado con éxito', Response::HTTP_OK);
    }
    
    
    

    public function obtenerFavoritos(Usuario $usuario)
    {
        return $this->entityManager->getRepository(Favorito::class)->findBy(['usuario' => $usuario]);
    }
}
