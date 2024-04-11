<?php

namespace App\Http\Requests;

use App\Utils\Message;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BookOutputRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'book_id' => ['required', 'integer', 'exists:App\Models\Book,id'],
            'name' => ['required', 'string', 'min:3'],
            'identification' => ['required', 'string', 'min:4'],
            'return_date' => ['required', 'date'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        Message::danger(message: $validator->errors()->first());
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
