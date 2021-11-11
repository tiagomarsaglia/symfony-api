<?php

namespace App\Controller\Shared;

use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\ServerBag;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AbstractRequestValidation.
 *
 * @property ParameterBag $attributes
 * @property ParameterBag $request
 * @property ParameterBag $query
 * @property ServerBag    $server
 * @property FileBag      $files
 * @property ParameterBag $cookies
 * @property HeaderBag    $headers
 *
 * @method duplicate(array $query, array $request, array $attributes, array $cookies, array $files, array $server)
 * @method overrideGlobals()
 */
abstract class AbstractRequestValidation
{
    use ValidationAwareTrait;
    use ValidationTrait;

    /** @var ValidatorInterface */
    private $validator;

    public function __construct(RequestStack $request, ValidatorInterface $validator)
    {
        $this->httpRequest = $request->getCurrentRequest();
        $this->validator = $validator;

        $this->initialize();
    }

    final public function initialize(): void
    {
        if (!$this->passesAuthorization()) {
            $this->failedAuthorization();
        }

        $this->validate();
    }

    /**
     * Get all request parameters.
     */
    final public function all(): array
    {
        return $this->httpRequest->attributes->all()
            + $this->httpRequest->query->all()
            + $this->httpRequest->request->all()
            + $this->httpRequest->files->all()
            + json_decode($this->httpRequest->getContent(), true);
    }

    /**
     * Determine if the request passes the authorization check.
     */
    final protected function passesAuthorization(): bool
    {
        if (method_exists($this, 'authorize')) {
            return $this->authorize();
        }

        return true;
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @throws AccessDeniedHttpException
     */
    final protected function failedAuthorization(): void
    {
        throw new AccessDeniedHttpException();
    }

    /**
     * @throws ValidationException
     */
    final protected function validate(): bool
    {
        /** @var ConstraintViolationList $violations */
        $data = $this->all();

        if (isset($data)) {
            $this->setValues($data);
        }

        $violations = $this->validator->validate($this);

        if ($violations->count()) {
            throw new ValidationException($this->validator, $violations);
        }

        return true;
    }
}
