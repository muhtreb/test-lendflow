<?php

namespace App\Application\Rules;

use App\Domain\NyTimes\Rules\OffsetRule;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NyTimesOffsetRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            new OffsetRule()->validate($value);
        } catch (\InvalidArgumentException $e) {
            $fail($e->getMessage());
        }
    }
}
