<?php

namespace App\Controller\PessoaJuridica;

use App\Controller\Shared\AbstractRequestValidation;
use App\Validator as AcmeAssert;
use Symfony\Component\Validator\Constraints as Assert;

class PessoaJuridicaValidation extends AbstractRequestValidation
{
    /** @Assert\NotNull */
    public string  $nome;
    
    /**
     *  @Assert\NotNull
     */
    public string  $cnpj;
    
    /** 
     * @Assert\NotNull
     * @Assert\Email()
     */
    public string  $email;

    /** @Assert\NotNull */
    public string  $senha;

}
