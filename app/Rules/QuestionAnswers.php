<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class QuestionAnswers implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $item){
            if($item['answer'] === "" || $item['answer'] === null){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The answer cannot be empty';
    }
}
