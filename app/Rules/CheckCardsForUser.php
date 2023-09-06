<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCardsForUser implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var User $user */
        $user = auth()->user();
        $check = $user->cards()->count() > 1;

        if ($check === false) {
            $fail('You must have more than one card created to perform this action.');
        }
    }
}
