<?php

namespace App\Space;

class PasswordGenerator
{

    /**
     * Generate verification code
     *
     * @return int|mixed
     */
    public function generate(int $length = null)
    {
        $number = '';

        if (is_null($length))
            $length = config('auth.defaults.password_length');

        for ($i = 0; $i < $length; $i++) {

            $number .= rand(1, 9);
        }

        return $number;
    }
}
