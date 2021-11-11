<?php

namespace App\Service;

use App\Controller\Shared\AbstractRequestValidation;
use App\Entity\Carteira;
use App\Entity\Shared\AbstractEntity;
use App\Service\Shared\AbstractService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

class CarteiraService extends AbstractService
{
    
    public function getRepository()
    {
        return $this->em->getRepository(Carteira::class);
    }

}
