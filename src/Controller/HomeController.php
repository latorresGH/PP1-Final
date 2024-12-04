<?php
// src/Controller/HomeController.php

namespace App\Controller;

use App\Repository\PeliculaRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(PeliculaRepository $peliculaRepository, SerieRepository $serieRepository): Response
    {
        // Obtener todas las películas desde el repositorio
        $peliculas = $peliculaRepository->findAll();
        $series = $serieRepository->findAll();

        $peliculasMasVistas = $peliculaRepository->findBy([], ['vistas' => 'DESC'], 4);

        // Renderizar la vista pasando las películas
        return $this->render('home/index.html.twig', [
            'peliculas' => $peliculas,
            'series' => $series,
            'peliculasMasVistas' => $peliculasMasVistas,
        ]);
    }
    
}
