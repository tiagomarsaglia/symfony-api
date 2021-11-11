<?php

namespace App\Controller\Usuario;

use App\Service\UsuarioService;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    public UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Retorna uma lista do cadastro de Usuarios e suas carteiras"
     * )
     * @OA\Tag(name="usuarios")
     */
    #[Route('/usuarios', name: 'usuarios', methods: ['GET'])]
    public function index(): Response
    {
        return $this->json($this->usuarioService->search());
    }
}
