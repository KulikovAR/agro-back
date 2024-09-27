<?php

namespace App\Traits;

trait UserProfileRules
{
    protected function isRequired(?bool $isRequired = false): array
    {
        return $isRequired ? ['required'] : ['nullable'];
    }
}
