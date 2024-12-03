<?php
namespace App\Controller;

use App\Entity\Pelicula;
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

    #[Route('/admin/panel', name: 'admin_panel')]
    public function index(): Response
    {
        // Obtener todas las películas
        $peliculas = $this->entityManager->getRepository(Pelicula::class)
        ->findBy([], ['vistas' => 'DESC']);

        // Pasar las películas al template
        return $this->render('admin/adminPanel.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }
}
