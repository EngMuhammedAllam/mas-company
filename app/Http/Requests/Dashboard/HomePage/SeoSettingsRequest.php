<?php

namespace App\Http\Requests\Dashboard\HomePage;

use Illuminate\Foundation\Http\FormRequest;

class SeoSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'robots' => ['nullable', 'string', 'max:120'],
        ];
    }

    public function attributes(): array
    {
        return [
            'meta_title' => 'عنوان الصفحة',
            'meta_description' => 'وصف الصفحة',
            'canonical_url' => 'الرابط الأساسي',
            'robots' => 'توجيهات محركات البحث',
        ];
    }

    public function messages(): array
    {
        return [
            'meta_description.max' => 'وصف الصفحة طويل جدًا (الحد الأقصى 500 حرف).',
            'canonical_url.url' => 'الرابط الأساسي يجب أن يكون رابطًا صحيحًا.',
        ];
    }
}
