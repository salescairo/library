<?php

namespace App\Http\Requests;

use App\Utils\Message;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'min:2', 'max:80', 'unique:App\Models\Book,name'],
            'year' => ['required', 'integer', 'max:' . now()->year],
            'brand_id' => ['required', 'integer', 'exists:App\Models\Brand,id'],
            'gender_id' => ['required', 'integer', 'exists:App\Models\Gender,id'],
        ];
        $this->route()->parameter(name: 'livro')
            && $rules['name'] = ['required', 'string', 'min:2', 'max:80', 'unique:App\Models\Book,name,' . $this->route()->parameter(name: 'livro')];
        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        Message::danger(message: $validator->errors()->first());
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
