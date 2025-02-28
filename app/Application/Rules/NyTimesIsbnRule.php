<?php

namespace App\Application\Rules;

use App\Domain\NyTimes\Rules\IsbnRule;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NyTimesIsbnRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            new IsbnRule()->validate($value);
        } catch (\InvalidArgumentException $e) {
            $fail($e->getMessage());
        }
    }
}
