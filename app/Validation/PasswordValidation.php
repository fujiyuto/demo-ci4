<?php

namespace App\Validation;

class PasswordValidation
{
    public function password($value, ?string &$error = null): bool
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/';

        return preg_match($pattern, $value);
    }
}
