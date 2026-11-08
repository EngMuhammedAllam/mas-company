<?php

namespace App\Http\Requests\Dashboard\HomePage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReorderItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'direction' => ['required', Rule::in(['up', 'down'])],
        ];
    }

    public function messages(): array
    {
        return [
            'direction.required' => 'اتجاه الترتيب مطلوب.',
            'direction.in' => 'اتجاه الترتيب غير صالح.',
        ];
    }
}
