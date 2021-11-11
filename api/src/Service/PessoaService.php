<?php

namespace App\Service;

use App\Entity\Pessoa;
use App\Service\Shared\AbstractService;

class PessoaService extends AbstractService
{
    public function getRepository()
    {
        return $this->em->getRepository(Pessoa::class);
    }
}
