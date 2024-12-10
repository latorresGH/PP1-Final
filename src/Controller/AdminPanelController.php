<?php
namespace App\Controller;

use App\Entity\Pelicula;
use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/peliculas', name: 'admin_peliculas')]
    public function index(): Response
    {
        // Obtener todas las películas
        $peliculas = $this->entityManager->getRepository(Pelicula::class)
        ->findBy([], ['vistas' => 'DESC']);

        // Pasar las películas al template
        return $this->render('admin/adminPeliculas.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }

    #[Route('/admin/series', name: 'admin_series')]
    public function seriesAdmin(): Response
    {
        // Obtener todas las series
        $series = $this->entityManager->getRepository(Serie::class)
        ->findBy([], ['vistas' => 'DESC']);

        // Pasar las series al template
        return $this->render('admin/adminSerie.html.twig', [
            'series' => $series,
        ]);
    }
}
