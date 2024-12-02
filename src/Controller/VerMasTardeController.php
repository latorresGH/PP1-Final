<?php

namespace App\Controller;

use App\Manager\VerMasTardeManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VerMasTardeController extends AbstractController
{
    private $verMasTardeManager;

    public function __construct(VerMasTardeManager $verMasTardeManager)
    {
        $this->verMasTardeManager = $verMasTardeManager;
    }

    #[Route('/vermas/agregar', name: 'vermas_agregar')]
    public function addVerMasTarde(Request $request)
    {
        $usuario = $this->getUser();
        $peliculaId = $request->get('pelicula_id');
        $serieId = $request->get('serie_id');

        // Agregar la película o serie a la lista "Ver Más Tarde"
        $this->verMasTardeManager->agregarVerMasTarde($usuario, $peliculaId, $serieId);

        return $this->redirectToRoute('vermas_lista');
    }

    #[Route('/vermas/eliminar', name: 'vermas_eliminar')]
    public function removeVerMasTarde(Request $request)
    {
        $usuario = $this->getUser();
        $peliculaId = $request->get('pelicula_id');
        $serieId = $request->get('serie_id');

        // Eliminar la película o serie de la lista "Ver Más Tarde"
        $this->verMasTardeManager->eliminarVerMasTarde($usuario, $peliculaId, $serieId);

        return $this->redirectToRoute('vermas_lista');
    }

    #[Route('/vermas', name: 'vermas_lista')]
    public function listVerMasTarde()
    {
        $usuario = $this->getUser();
        $verMasTarde = $this->verMasTardeManager->obtenerVerMasTarde($usuario);

        return $this->render('tarde/index.html.twig', [
            'verMasTarde' => $verMasTarde,
        ]);
    }
}
