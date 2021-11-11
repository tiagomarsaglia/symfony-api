<?php

namespace App\Controller\PessoaFisica;

use App\Entity\PessoaFisica;
use App\Service\PessoaFisicaService;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PessoaFisicaController extends AbstractController
{
    public PessoaFisicaService $pessoaFisicaService;

    public function __construct(PessoaFisicaService $pessoaFisicaService)
    {
        $this->pessoaFisicaService = $pessoaFisicaService;
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Retorna uma lista do cadastro de Pessoas Fisicas"
     * )
     * @OA\Tag(name="pessoa_fisica")
     */
    #[Route('/pessoa/fisica', name: 'pessoa_fisica', methods: ['GET'])]
    public function index(): Response
    {
        return $this->json($this->pessoaFisicaService->search());
    }

    /**
     * @OA\Post(
     *     path="/pessoa/fisica/create",
     *     summary="Realiza o cadastro de um novo usuário pessoa fisica",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                     property="cpf",
     *                     type="string"
     *                  ),
     *                  @OA\Property(
     *                     property="nome",
     *                     type="string"
     *                  ),
     *                  @OA\Property(
     *                     property="email",
     *                     type="string"
     *                  ),
     *                  @OA\Property(
     *                     property="senha",
     *                     type="string"
     *                  ),
     *                  example={"cpf": "12345678909", "nome": "Jessica Smith", "email": "teste@testse.com", "senha": "12345678"}
     *              )
     *         )
     *     )
     * )
     * @OA\Response(
     *     response=200,
     *     description="Retorna o cadastro realizado"
     * )
     * @OA\Tag(name="pessoa_fisica_create")
     */
    #[Route('/pessoa/fisica/create', name: 'pessoa_fisica_create', methods: ['POST'])]
    public function createPessoaFisica(PessoaFisicaValidation $request): Response
    {
        try {
            $response = $this->pessoaFisicaService->create(new PessoaFisica(), $request);

            return $this->json($response->toArray());
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
