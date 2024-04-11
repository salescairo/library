<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;

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
        parent::failedValidation($validator);
        Toast::title(title: 'Ops')
            ->message($validator->errors()->first())
            ->centerBottom()
            ->autoDismiss(afterSeconds: 20);
    }
}
