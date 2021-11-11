<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * Class ValidaCpf
 */
class ValidaCpf extends Constraint {

    public $message = 'O CPF informado é inválido.';
}
