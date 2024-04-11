<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:80', 'unique:App\Models\Book,name'],
            'year' => ['required', 'integer', 'max:' . now()->year],
            'brand_id' => ['required', 'integer', 'exists:App\Models\Brand,id'],
            'gender_id' => ['required', 'integer', 'exists:App\Models\Gender,id'],
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
