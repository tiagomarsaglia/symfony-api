<?php

namespace App\Service;

use App\Entity\Carteira;
use App\Service\Shared\AbstractService;

class CarteiraService extends AbstractService
{
    public function getRepository()
    {
        return $this->em->getRepository(Carteira::class);
    }
}
