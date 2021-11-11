<?php

namespace App\Service\Shared;

use App\Controller\Shared\AbstractRequestValidation;
use App\Entity\Shared\AbstractEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Exception\ValidatorException;

abstract class AbstractService
{
    protected EntityManagerInterface $em;
    protected ValidatorInterface $validator;

    public function __construct(EntityManagerInterface $em, ValidatorInterface $validator) 
    {
        $this->em = $em;
        $this->validator = $validator;
    }

    public function create(AbstractEntity $entity, AbstractRequestValidation $validationData): AbstractEntity|ConstraintViolationListInterface
    {
        $entity->setValues($validationData->toArray());
        $error = $this->validator->validate($entity);
        if ($error->count() == 0) {
            $this->em->persist($entity);
            $this->em->flush();
            return $entity;
        }
        throw new ValidatorException("Os dados não são compativeis com o modelo de dados");
    }

    public function update(AbstractEntity $entity, AbstractRequestValidation $validationData): AbstractEntity|ConstraintViolationListInterface
    {
        $entity = $this->em->getRepository(get_class($entity))->find($validationData->id);
        if (empty($entity)) {
            throw new NotFoundHttpException("O registro de ID: {$validationData->id} não pode ser localizado.");
        }
        $entity->setValues($validationData->toArray());
        $error = $this->validator->validate($entity);
        if ($error->count() == 0) {
            $this->em->persist($entity);
            $this->em->flush();
            return $entity;
        }
        throw new ValidatorException("Os dados não são compativeis com o modelo de dados");
    }

    public function delete(AbstractEntity $entityInput, AbstractRequestValidation $validationData): array
    {
        $entity = $this->em->getRepository(get_class($entityInput))->find($validationData->id);
        if (empty($entity)) {
            throw new NotFoundHttpException("O registro de ID: {$validationData->id} não pode ser localizado.");
        }
        $this->em->remove($entity);
        $this->em->flush();
        return [
            "O registro de ID: {$validationData->id} foi removido com sucesso."
        ];
    }

    public function patch(AbstractEntity $entityInput, AbstractRequestValidation $validationData)
    {
        return $this->update($entityInput, $validationData);
    }

    public function search($parameters = [])
    {
        return $this->getRepository()->findAll();
    }

    abstract public function getRepository();
}
