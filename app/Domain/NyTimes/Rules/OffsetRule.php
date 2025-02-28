<?php

namespace App\Domain\NyTimes\Rules;

class OffsetRule
{
    public function validate(mixed $value): bool
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('offset must be numeric.');
        }

        if ($value % 20 !== 0) {
            throw new \InvalidArgumentException('offset must be a multiple of 20.');
        }

        return true;
    }
}
