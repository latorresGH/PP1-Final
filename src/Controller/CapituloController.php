<?php
// src/Controller/CapituloController.php
namespace App\Controller;

use App\Entity\Serie;
use App\Entity\Capitulo;
use App\Manager\CapituloManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CapituloController extends AbstractController
{
    private $entityManager;

    // Inyectamos EntityManagerInterface para acceder al repositorio
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/serie/{serieId}/capitulo/crear', name: 'capitulo_create')]
    public function create(int $serieId, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Buscar la serie a la que se le quiere agregar el capítulo
        $serie = $entityManager->getRepository(Serie::class)->find($serieId);

        if (!$serie) {
            throw $this->createNotFoundException('La serie no existe.');
        }

        // Si el formulario se envía, procesamos los datos
        if ($request->isMethod('POST')) {
            $titulo = $request->request->get('titulo');
            $archivo = $request->files->get('archivo');

            // Crear un nuevo capítulo
            $capitulo = new Capitulo();
            $capitulo->setTitulo($titulo);
            $capitulo->setSerie($serie);  // Asociamos el capítulo a la serie

            // Manejo del archivo (archivo de video)
            if ($archivo) {
                // Definir el directorio donde se almacenará el archivo
                $archivoPath = 'uploads/capitulos/' . $archivo->getClientOriginalName();
                $archivo->move($this->getParameter('kernel.project_dir') . '/public/uploads/capitulos', $archivo->getClientOriginalName());
                $capitulo->setArchivo($archivoPath);  // Guardamos la ruta del archivo en la entidad Capitulo
            }

            // Guardar el capítulo en la base de datos
            $entityManager->persist($capitulo);
            $entityManager->flush();

            // Redirigir a la página de la serie o mostrar mensaje de éxito
            return $this->redirectToRoute('get_capitulos', ['id' => $serieId]);  // Ajusta la ruta según tu estructura
        }

        // Renderizar la vista de creación del capítulo
        return $this->render('capitulo/create.html.twig', [
            'serie' => $serie,
        ]);
    }


    #[Route('/serie/{id}/capitulos', name: 'get_capitulos')]
    public function getCapitulos(int $id): Response
    {
        // Obtener la serie por su ID
        $serie = $this->entityManager->getRepository(Serie::class)->find($id);
    
        if (!$serie) {
            return new Response('Serie no encontrada', Response::HTTP_NOT_FOUND);
        }
    
        // Obtener los capítulos de la serie
        $capitulos = $serie->getCapitulos();
    
        // Renderizar la vista con los capítulos
        return $this->render('capitulo/index.html.twig', [
            'serie' => $serie,  // Pasamos la serie completa con los capítulos
        ]);
    }

    #[Route('/serie/{serieId}/capitulo/{capituloId}/editar', name: 'capitulo_edit')]
    public function edit(int $serieId, int $capituloId, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Buscar la serie y el capítulo por sus IDs
        $serie = $entityManager->getRepository(Serie::class)->find($serieId);
        $capitulo = $entityManager->getRepository(Capitulo::class)->find($capituloId);

        if (!$serie || !$capitulo) {
            throw $this->createNotFoundException('La serie o el capítulo no existen.');
        }

        // Si se recibe una solicitud POST, actualizamos los datos
        if ($request->isMethod('POST')) {
            $titulo = $request->request->get('titulo');
            $archivo = $request->files->get('archivo');

            // Actualizar título del capítulo
            $capitulo->setTitulo($titulo);

            // Si se sube un nuevo archivo, actualizamos el archivo del capítulo
            if ($archivo) {
                // Guardar el archivo en la carpeta 'uploads/capitulos' y obtener su ruta
                $archivoPath = 'uploads/capitulos/' . $archivo->getClientOriginalName();
                $archivo->move($this->getParameter('capitulos_directory'), $archivo->getClientOriginalName());
                $capitulo->setArchivo($archivoPath);  // Actualizamos el archivo en la entidad Capitulo
            }

            // Persistir los cambios en la base de datos
            $entityManager->flush();

            // Redirigir a la vista del capítulo o mostrar un mensaje de éxito
            return $this->redirectToRoute('serie_show', ['id' => $serieId]);  // Ajusta la ruta según tu estructura
        }

        // Renderizar la vista de edición del capítulo
        return $this->render('capitulo/edit.html.twig', [
            'serie' => $serie,
            'capitulo' => $capitulo,
        ]);
    }
}
