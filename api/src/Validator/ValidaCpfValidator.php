<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidaCpfValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ('' !== $value) {
            if (!$this->validarCpf($value)) {
                $this->context->addViolation($constraint->message);

                return false;
            }
        }

        return $value;
    }

    /**
     * @param string $val
     *
     * @return bool
     */
    protected function validarCpf($val)
    {
        $value = preg_replace('/[^0-9]/', '', $val);

        for ($i = 0; $i <= 9; ++$i) {
            $repetidos = str_pad('', \mb_strlen($value), $i);
            if ($value === $repetidos) {
                return false;
            }
        }

        if ('01234567890' === $value) {
            return false;
        }

        $weights = 11;

        for ($weight = ($weights - 1), $digit = (\mb_strlen($value) - 2); $weight <= $weights; $weight++, $digit++) {
            for ($sum = 0, $i = 0, $position = $weight; $position >= 2; $position--, $i++) {
                $sum = $sum + ($value[$i] * $position);
            }

            $sum = ((10 * $sum) % 11) % 10;

            if ($value[$digit] !== $sum) {
                return false;
            }
        }

        return true;
    }
}
