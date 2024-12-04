<?php

namespace App\Controller;


use App\Entity\Pelicula;
use App\Entity\Usuario;
use App\Manager\FavoritosManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class FavoritosController extends AbstractController
{
    private FavoritosManager $favoritosManager;
    private EntityManagerInterface $entityManager;
    // private $logger;
    

    public function __construct(EntityManagerInterface $entityManager, FavoritosManager $favoritosManager)
    {
        $this->favoritosManager = $favoritosManager;
        // $this->logger = $logger;
    }

    #[Route('/favoritos/agregar', name: 'favoritos_agregar')]
    public function addFavorito(Request $request): RedirectResponse
    {
        $usuario = $this->getUser();
        if (!$usuario instanceof Usuario) {
            throw $this->createAccessDeniedException('El usuario no está autenticado.');
        }

        [$peliculaId, $serieId] = $this->obtenerParametros($request);

        $this->favoritosManager->agregarFavorito($usuario, $peliculaId, $serieId);

        return $this->redirectToRoute('favoritos_lista');
    }

    #[Route('/favoritos', name: 'favoritos_lista')]
    public function listFavoritos(): Response
    {
        $usuario = $this->getUser();
        if (!$usuario instanceof Usuario) {
            throw $this->createAccessDeniedException('El usuario no está autenticado.');
        }

        $favoritos = $this->favoritosManager->obtenerFavoritos($usuario);

        return $this->render('favoritos/index.html.twig', [
            'favoritos' => $favoritos,
        ]);
    }

    #[Route('/eliminar/{id}', name: 'favorito_eliminar', methods: ['POST'])]
    public function eliminarFavorito(int $id, FavoritosManager $favoritosManager)
    {
        // Intentamos eliminar el favorito
        $respuesta = $favoritosManager->eliminarFavorito($id);
        
        // Si la respuesta fue exitosa, redirigimos
        if ($respuesta) {
            return $this->redirectToRoute('favoritos_lista');
        }
    
        // En caso de error, redirigimos a la página de error
        return $this->redirectToRoute('error_page');
    }
      
    // Controlador

    public function panelAdministrador(): Response
    {
        // Obtener las películas
        $peliculas = $this->entityManager->getRepository(Pelicula::class)->findAll();

        // Pasar las películas y el conteo de favoritos al Twig
        return $this->render('admin/adminPanel.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }


        
    private function obtenerParametros(Request $request): array
    {
        $peliculaId = $request->get('pelicula_id');
        $serieId = $request->get('serie_id');
        if (!$peliculaId && !$serieId) {
            throw $this->createNotFoundException('Debe proporcionarse una película o una serie.');
        }
        return [$peliculaId, $serieId];
    }
}
