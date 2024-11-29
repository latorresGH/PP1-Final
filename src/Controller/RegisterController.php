<?php
namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $nombre = $request->get('nombre');
            $email = $request->get('email');
            $password = $request->get('password');
            $confirmarContrasena = $request->get('confirmar_contrasena');

            if ($password !== $confirmarContrasena) {
                $this->addFlash('error', 'Las contraseñas no coinciden.');
                return $this->redirectToRoute('app_register');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->addFlash('error', 'El correo electrónico no es válido.');
                return $this->redirectToRoute('app_register');
            }

            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setEmail($email);

            $hashedPassword = $passwordHasher->hashPassword($usuario, $password);
            $usuario->setPassword($hashedPassword);

            $entityManager->persist($usuario);
            $entityManager->flush();
            

            return $this->redirectToRoute('home'); // Redirigir al home
        }

        return $this->render('register/index.html.twig');
    }
}
