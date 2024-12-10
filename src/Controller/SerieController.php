<?php
// src/Controller/SerieController.php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/series', name: 'series_list')]
    public function list(SerieRepository $serieRepository): Response
    {
        $series = $serieRepository->findAll();

        return $this->render('serie/list.html.twig', [
            'series' => $series,
        ]);
    }

    #[Route('/series/nueva', name: 'series_new')]
    public function new(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $titulo = $request->request->get('titulo');
            $descripcion = $request->request->get('descripcion');
            $duracion = $request->request->get('duracion');
            $temporadas = $request->request->get('temporadas');
            $imagen = $request->files->get('imagen');
            $archivo = $request->files->get('archivo');

            $serie = new Serie();
            $serie->setTitulo($titulo);
            $serie->setDescripcion($descripcion);
            $serie->setDuracion($duracion);
            $serie->setTemporadas($temporadas);

            if ($imagen) {
                $imagenPath = 'path/to/uploads/' . $imagen->getClientOriginalName();
                $imagen->move('path/to/uploads/', $imagen->getClientOriginalName());
                $serie->setImagen($imagenPath);
            }

            if ($archivo) {
                $archivoPath = 'path/to/uploads/' . $archivo->getClientOriginalName();
                $archivo->move('path/to/uploads/', $archivo->getClientOriginalName());
                $serie->setArchivo($archivoPath);
            }

            $this->entityManager->persist($serie);
            $this->entityManager->flush();

            return $this->redirectToRoute('series_list');
        }

        return $this->render('serie/new.html.twig');
    }

    #[Route('/series/{id}/editar', name: 'series_edit')]
    public function edit(int $id, Request $request, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);

        if (!$serie) {
            throw $this->createNotFoundException('La serie no existe.');
        }

        if ($request->isMethod('POST')) {
            $titulo = $request->request->get('titulo');
            $descripcion = $request->request->get('descripcion');
            $duracion = $request->request->get('duracion');
            $temporadas = $request->request->get('temporadas');
            $imagen = $request->files->get('imagen');
            $archivo = $request->files->get('archivo');

            $serie->setTitulo($titulo);
            $serie->setDescripcion($descripcion);
            $serie->setDuracion($duracion);
            $serie->setTemporadas($temporadas);

            if ($imagen) {
                $imagenPath = 'path/to/uploads/' . $imagen->getClientOriginalName();
                $imagen->move('path/to/uploads/', $imagen->getClientOriginalName());
                $serie->setImagen($imagenPath);
            }

            if ($archivo) {
                $archivoPath = 'path/to/uploads/' . $archivo->getClientOriginalName();
                $archivo->move('path/to/uploads/', $archivo->getClientOriginalName());
                $serie->setArchivo($archivoPath);
            }

            $this->entityManager->flush();

            return $this->redirectToRoute('series_list');
        }

        return $this->render('serie/edit.html.twig', [
            'serie' => $serie,
        ]);
    }

    #[Route('/series/{id}/eliminar', name: 'series_delete')]
    public function delete(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);

        if (!$serie) {
            throw $this->createNotFoundException('La serie no existe.');
        }

        $this->entityManager->remove($serie);
        $this->entityManager->flush();

        return $this->redirectToRoute('series_list');
    }

    #[Route('/series/ver/{id}', name: 'series_ver')]
    public function verSerie(int $id): Response
    {
        $serie = $this->entityManager->getRepository(Serie::class)->find($id);

        if (!$serie) {
            throw $this->createNotFoundException('La serie no existe.');
        }

        $serie->incrementarVista();
        $this->entityManager->flush();

        return $this->render('serie/ver.html.twig', [
            'serie' => $serie,
        ]);
    }
}
