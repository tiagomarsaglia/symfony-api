<?php

namespace App\Controller\Transacao;

use App\Service\TransacaoService;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransacaoController extends AbstractController
{
    public TransacaoService $transacaoService;

    public function __construct(TransacaoService $transacaoService)
    {
        $this->transacaoService = $transacaoService;
    }

    /**
     * @OA\Post(
     *     path="/transacao",
     *     summary="Realiza uma nova transação",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                     property="valor",
     *                     type="float"
     *                  ),
     *                  @OA\Property(
     *                     property="pagador",
     *                     type="integer"
     *                  ),
     *                  @OA\Property(
     *                     property="beneficiario",
     *                     type="integer"
     *                  ),
     *                  example={"valor": 20, "pagador": 1, "beneficiario": 2}
     *              )
     *         )
     *     )
     * )
     * @OA\Response(
     *     response=200,
     *     description="Retorna se a transação foi realizada com sucesso"
     * )
     * @OA\Tag(name="transacao")
     */
    #[Route('/transacao', name: 'transacao', methods: ['POST'])]
    public function createTransacao(TransacaoValidation $request): Response
    {
        try {
            $response = $this->transacaoService->create($request);

            return $this->json(
                ['message' => 'Transação realizada com sucesso'],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
