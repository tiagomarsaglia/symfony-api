<?php

namespace App\Controller\PessoaJuridica;

use App\Entity\PessoaJuridica;
use App\Service\PessoaJuridicaService;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PessoaJuridicaController extends AbstractController
{
    public PessoaJuridicaService $pessoaJuridicaService;

    public function __construct(PessoaJuridicaService $pessoaJuridicaService)
    {
        $this->pessoaJuridicaService = $pessoaJuridicaService;
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Retorna uma lista do cadastro de Pessoas Juridica"
     * )
     * @OA\Tag(name="pessoa_juridica")
     */
    #[Route('/pessoa/juridica', name: 'pessoa_juridica', methods: ['GET'])]
    public function index(): Response
    {
        return $this->json($this->pessoaJuridicaService->search());
    }

    /**
     * @OA\Post(
     *     path="/pessoa/juridica/create",
     *     summary="Realiza o cadastro de um novo usuário pessoa juridica",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                     property="cnpj",
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
     *                  example={"cnpj": "37596495000173", "nome": "Jessica Smith", "email": "teste@testse.com", "senha": "12345678"}
     *              )
     *         )
     *     )
     * )
     * @OA\Response(
     *     response=200,
     *     description="Retorna o cadastro realizado"
     * )
     * @OA\Tag(name="pessoa_juridica_create")
     */
    #[Route('/pessoa/juridica/create', name: 'pessoa_juridica_create', methods: ['POST'])]
    public function createPessoaFisica(PessoaJuridicaValidation $request): Response
    {
        try {
            $response = $this->pessoaJuridicaService->create(new PessoaJuridica(), $request);

            return $this->json($response->toArray());
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
