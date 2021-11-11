<?php

namespace App\Service;

use App\Controller\Shared\AbstractRequestValidation;
use App\Entity\Carteira;
use App\Entity\Pessoa;
use App\Entity\PessoaJuridica;
use App\Entity\Shared\AbstractEntity;
use App\Entity\Usuario;
use App\Service\Shared\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PessoaJuridicaService extends AbstractService
{

    protected PessoaService $pessoaService;
    protected UsuarioService $usuarioService;
    protected CarteiraService $carteiraService;

    public function __construct(
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        PessoaService $pessoaService,
        CarteiraService $carteiraService,
        UsuarioService $usuarioService
    ) {
        $this->pessoaService = $pessoaService;
        $this->carteiraService = $carteiraService;
        $this->usuarioService = $usuarioService;
        parent::__construct($em, $validator);
    }

    
    public function create(AbstractEntity $entity, AbstractRequestValidation $validationData): AbstractEntity|ConstraintViolationListInterface
    {
        $this->em->beginTransaction();
        $this->em->getConnection()->setAutoCommit(false);
        try {
            $pessoa = $this->pessoaService->create(new Pessoa(), $validationData);

            $usuario = new Usuario();
            $usuario->setPessoa($pessoa);
            $usuario = $this->usuarioService->create($usuario, $validationData);

            $pessoaFisica = new PessoaJuridica();
            $pessoaFisica->setValues($validationData->toArray());
            $pessoaFisica->setPessoa($pessoa);

            $carteira =  new Carteira();
            $carteira->setUsuario($usuario);
            $carteira->setSaldo(100);
            $carteira = $this->carteiraService->create($carteira, $validationData);
            
            $error = $this->validator->validate($pessoaFisica);
            if ($error->count() == 0) {
                $this->em->persist($pessoaFisica);
                $this->em->flush();
                $this->em->commit();
                $this->em->getConnection()->setAutoCommit(true);
                return $pessoaFisica;
            }
            
            throw new ValidatorException("Os dados não são compativeis com o modelo de dados");
        } catch (\Exception $e) {
            $this->em->clear();
            $this->em->rollback();
            $this->em->getConnection()->setAutoCommit(true);

            throw $e;
        }
    }

    public function getRepository()
    {
        return $this->em->getRepository(PessoaJuridica::class);
    }
}
