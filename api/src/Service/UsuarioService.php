<?php

namespace App\Service;

use App\Entity\Usuario;
use App\Service\Shared\AbstractService;

class UsuarioService extends AbstractService
{
    public function getRepository()
    {
        return $this->em->getRepository(Usuario::class);
    }
}
