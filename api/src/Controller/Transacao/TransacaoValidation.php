<?php

namespace App\Controller\Transacao;

use App\Controller\Shared\AbstractRequestValidation;
use App\Validator as AcmeAssert;
use Symfony\Component\Validator\Constraints as Assert;

class TransacaoValidation extends AbstractRequestValidation
{
    /** @Assert\NotNull */
    public float  $valor;
    
    /**
     *  @Assert\NotNull
     */
    public int  $pagador;
    
    /** @Assert\NotNull */
    public int  $beneficiario;

}
