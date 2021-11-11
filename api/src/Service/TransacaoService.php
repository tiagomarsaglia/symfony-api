<?php

namespace App\Service;

use App\Controller\Shared\AbstractRequestValidation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

class TransacaoService
{
    protected UsuarioService $usuarioService;
    protected CarteiraService $carteiraService;
    protected AutorizationService $atorizationService;
    protected OperacaoService $operacaoService;
    protected EntityManagerInterface $em;
    protected NotificationService $notificationService;

    public function __construct(
        OperacaoService $operacaoService,
        AutorizationService $atorizationService,
        NotificationService $notificationService,
        EntityManagerInterface $em,
        UsuarioService $usuarioService,
    ) {
        $this->usuarioService = $usuarioService;
        $this->atorizationService = $atorizationService;
        $this->operacaoService = $operacaoService;
        $this->notificationService = $notificationService;
        $this->em = $em;
    }


    public function create(AbstractRequestValidation $validationData)
    {
        $this->em->beginTransaction();
        $this->em->getConnection()->setAutoCommit(false);
        try {
            $pagador = $this->usuarioService->getRepository()->find($validationData->pagador);
            $beneficiario = $this->usuarioService->getRepository()->find($validationData->beneficiario);

            if (empty($pagador)) {
                throw new ValidatorException("Usuário de pagador não foi encontrado");
            }

            if (!empty($pagador->getPessoa()->getPessoaJuridica())) {
                throw new ValidatorException("Usuário de pessoa jurídica não pode realizar a operação de pagamento");
            }

            if (empty($beneficiario)) {
                throw new ValidatorException("Usuário de beneficiario não foi encontrado");
            }

            if (!$this->atorizationService->checkAutorization()) {
                throw new ValidatorException("Operação não autorizada");
            }

            $operacao = $this->operacaoService->sacar($pagador->getCarteira(), $validationData->valor);
            $operacao = $this->operacaoService->receber($beneficiario->getCarteira(), $validationData->valor);
            
            $this->em->commit();
            $this->em->getConnection()->setAutoCommit(true);

            if (!$this->notificationService->checkNotification()) {
                throw new ValidatorException("Não foi possível notificar os usuários");
            }

            return $operacao;
        } catch (\Exception $e) {
            $this->em->clear();
            $this->em->rollback();
            $this->em->getConnection()->setAutoCommit(true);

            throw $e;
        }
    }
}
