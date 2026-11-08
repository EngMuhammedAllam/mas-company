<?php

namespace App\Http\Requests\Dashboard\HomePage;

use Illuminate\Foundation\Http\FormRequest;

class HomeSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'highlighted_text' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:120'],
            'whatsapp_message' => ['nullable', 'string', 'max:1000'],
            'secondary_button_text' => ['nullable', 'string', 'max:120'],
            'secondary_whatsapp_message' => ['nullable', 'string', 'max:1000'],
            'settings' => ['nullable', 'array'],
            'settings.*' => ['nullable'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }

    public function attributes(): array
    {
        return [
            'eyebrow' => 'النص التمهيدي',
            'title' => 'العنوان',
            'highlighted_text' => 'النص المميز',
            'description' => 'الوصف',
            'image' => 'الصورة',
            'image_alt' => 'النص البديل للصورة',
            'button_text' => 'نص الزر',
            'whatsapp_message' => 'رسالة واتساب',
            'secondary_button_text' => 'نص الزر الثانوي',
            'secondary_whatsapp_message' => 'رسالة واتساب الثانوية',
            'sort_order' => 'الترتيب',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'الملف المرفوع يجب أن يكون صورة صالحة.',
            'image.mimes' => 'صيغة الصورة يجب أن تكون PNG أو JPG أو WEBP.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 4 ميجابايت.',
            'description.max' => 'الوصف طويل جدًا (الحد الأقصى 2000 حرف).',
        ];
    }
}
