<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AtLeastOneMeaningRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Access other fields using $this->otherFields
        return ! empty($value['bangla_meaning']) || ! empty($value['english_meaning']);
    }

    public function message()
    {
        return 'Please provide the meaning in at least one language (Bangla or English).';
    }
}
