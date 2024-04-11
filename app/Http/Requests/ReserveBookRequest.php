<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use ProtoneMedia\Splade\Facades\Toast;

class ReserveBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:80'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        parent::failedValidation($validator);
        Toast::title(title: 'Ops')
            ->message($validator->errors()->first())
            ->centerBottom()
            ->autoDismiss(afterSeconds: 20);
    }
}
