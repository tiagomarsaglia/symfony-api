<?php

namespace App\Controller\PessoaFisica;

use App\Controller\Shared\AbstractRequestValidation;
use Symfony\Component\Validator\Constraints as Assert;

class PessoaFisicaValidation extends AbstractRequestValidation
{
    /** @Assert\NotNull */
    public string  $nome;

    /**
     *  @Assert\NotNull
     */
    public string  $cpf;

    /**
     * @Assert\NotNull
     * @Assert\Email()
     */
    public string  $email;

    /** @Assert\NotNull */
    public string  $senha;
}
