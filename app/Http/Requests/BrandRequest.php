<?php

namespace App\Http\Requests;

use App\Utils\Message;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:80', 'unique:App\Models\Brand,name'],
            'enabled' => ['required', 'boolean'],
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
