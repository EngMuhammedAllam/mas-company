<?php

namespace App\Http\Requests\Dashboard\HomePage;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'equipment_category_id' => ['required', 'integer', 'exists:equipment_categories,id'],
            'name' => ['required', 'string', 'max:160'],
            'description' => ['required', 'string', 'max:1000'],
            // on edit the existing approved image is kept when no file is sent
            'image' => [$this->isMethod('POST') ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
            'is_available' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'equipment_category_id' => 'التصنيف',
            'name' => 'اسم المعدة',
            'description' => 'الوصف',
            'image' => 'صورة المعدة',
        ];
    }

    public function messages(): array
    {
        return [
            'equipment_category_id.required' => 'اختر التصنيف الذي تتبعه المعدة.',
            'equipment_category_id.exists' => 'التصنيف المختار غير موجود.',
            'name.required' => 'اسم المعدة مطلوب.',
            'description.required' => 'وصف المعدة مطلوب.',
            'description.max' => 'الوصف طويل جدًا (الحد الأقصى 1000 حرف).',
            'image.required' => 'صورة المعدة مطلوبة عند الإضافة.',
            'image.image' => 'الملف المرفوع يجب أن يكون صورة صالحة.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 4 ميجابايت.',
        ];
    }
}
