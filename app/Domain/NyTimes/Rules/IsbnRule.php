<?php

namespace App\Domain\NyTimes\Rules;

class IsbnRule
{
    public function validate(mixed $value): bool
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('isbn must be a string.');
        }

        if (str_ends_with($value, ';')) {
            throw new \InvalidArgumentException('isbn must not end with a semicolon.');
        }

        $isbns = explode(';', $value);

        foreach ($isbns as $isbn) {
            if (!preg_match('/^\d{10}$|^\d{13}$/', $isbn)) {
                throw  new \InvalidArgumentException('isbn must be a valid ISBN.');
            }
        }

        return true;
    }
}
