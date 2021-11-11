<?php

namespace App\Service;

use App\Entity\Carteira;
use App\Entity\Operacao;
use App\Entity\TipoOperacao;
use App\Service\Shared\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OperacaoService extends AbstractService
{
    protected CarteiraService $carteiraService;

    public function __construct(
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        CarteiraService $carteiraService,
    ) {
        $this->carteiraService = $carteiraService;
        parent::__construct($em, $validator);
    }

    public function receber(Carteira $carteira, float $valor): Operacao
    {
        $carteira->addSaldo($valor);
        $error = $this->validator->validate($carteira);
        if ($error->count() > 0) {
            throw new ValidatorException('Os dados não são compativeis com o modelo de dados');
        }
        $this->em->persist($carteira);

        $operacao = new Operacao();
        $operacao->setCarteira($carteira);
        $operacao->setValor($valor);
        $operacao->setTipoOperacao(TipoOperacao::RECEBER);

        $error = $this->validator->validate($operacao);
        if ($error->count() > 0) {
            throw new ValidatorException('Os dados não são compativeis com o modelo de dados');
        }
        $this->em->persist($operacao);
        $this->em->flush();

        return $operacao;
    }

    public function sacar(Carteira $carteira, float $valor): Operacao
    {
        $carteira->subSaldo($valor);
        $error = $this->validator->validate($carteira);
        if ($error->count() > 0) {
            throw new ValidatorException('Os dados não são compativeis com o modelo de dados');
        }
        $this->em->persist($carteira);
        $this->em->flush();

        $operacao = new Operacao();
        $operacao->setCarteira($carteira);
        $operacao->setValor($valor);
        $operacao->setTipoOperacao(TipoOperacao::SACAR);

        $error = $this->validator->validate($operacao);
        if ($error->count() > 0) {
            throw new ValidatorException('Os dados não são compativeis com o modelo de dados');
        }
        $this->em->persist($operacao);
        $this->em->flush();

        return $operacao;
    }

    public function getRepository()
    {
        return $this->em->getRepository(Operacao::class);
    }
}
