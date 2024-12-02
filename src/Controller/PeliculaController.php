<?php
// src/Controller/PeliculaController.php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Repository\PeliculaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeliculaController extends AbstractController
{
    #[Route('/peliculas', name: 'peliculas_list')]
    public function list(PeliculaRepository $peliculaRepository): Response
    {
        // Obtener todas las películas desde la base de datos
        $peliculas = $peliculaRepository->findAll();

        // Renderizar la vista con las películas
        return $this->render('pelicula/list.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }


    #[Route('/peliculas/nueva', name: 'peliculas_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $titulo = $request->request->get('titulo');
            $descripcion = $request->request->get('descripcion');
            $duracion = $request->request->get('duracion');
            $imagen = $request->files->get('imagen');
            $archivo = $request->files->get('archivo');

            // Crear una nueva película
            $pelicula = new Pelicula();
            $pelicula->setTitulo($titulo);
            $pelicula->setDescripcion($descripcion);
            $pelicula->setDuracion($duracion);

            // Manejo de los archivos (imagen y archivo)
            if ($imagen) {
                $imagenPath = 'path/to/uploads/' . $imagen->getClientOriginalName();
                $imagen->move('path/to/uploads/', $imagen->getClientOriginalName());
                $pelicula->setImagen($imagenPath);
            }

            if ($archivo) {
                $archivoPath = 'path/to/uploads/' . $archivo->getClientOriginalName();
                $archivo->move('path/to/uploads/', $archivo->getClientOriginalName());
                $pelicula->setArchivo($archivoPath);
            }

            // Persistir la película
            $entityManager->persist($pelicula);
            $entityManager->flush();

            return $this->redirectToRoute('peliculas_list');
        }

        return $this->render('pelicula/new.html.twig');
    }

    #[Route('/peliculas/{id}/editar', name: 'peliculas_edit')]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager, PeliculaRepository $peliculaRepository): Response
    {
        $pelicula = $peliculaRepository->find($id);

        if (!$pelicula) {
            throw $this->createNotFoundException('La película no existe.');
        }

        if ($request->isMethod('POST')) {
            $titulo = $request->request->get('titulo');
            $descripcion = $request->request->get('descripcion');
            $duracion = $request->request->get('duracion');
            $imagen = $request->files->get('imagen');
            $archivo = $request->files->get('archivo');

            // Actualizar la película
            $pelicula->setTitulo($titulo);
            $pelicula->setDescripcion($descripcion);
            $pelicula->setDuracion($duracion);

            // Manejo de archivos (imagen y archivo)
            if ($imagen) {
                $imagenPath = 'path/to/uploads/' . $imagen->getClientOriginalName();
                $imagen->move('path/to/uploads/', $imagen->getClientOriginalName());
                $pelicula->setImagen($imagenPath);
            }

            if ($archivo) {
                $archivoPath = 'path/to/uploads/' . $archivo->getClientOriginalName();
                $archivo->move('path/to/uploads/', $archivo->getClientOriginalName());
                $pelicula->setArchivo($archivoPath);
            }

            // Guardar cambios
            $entityManager->flush();

            return $this->redirectToRoute('peliculas_list');
        }

        return $this->render('pelicula/edit.html.twig', [
            'pelicula' => $pelicula
        ]);
    }

    #[Route('/peliculas/{id}/eliminar', name: 'peliculas_delete')]
    public function delete(int $id, EntityManagerInterface $entityManager, PeliculaRepository $peliculaRepository): Response
    {
        $pelicula = $peliculaRepository->find($id);

        if (!$pelicula) {
            throw $this->createNotFoundException('La película no existe.');
        }

        $entityManager->remove($pelicula);
        $entityManager->flush();

        return $this->redirectToRoute('peliculas_list');
    }
}
