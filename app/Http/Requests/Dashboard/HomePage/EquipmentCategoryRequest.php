<?php

namespace App\Http\Requests\Dashboard\HomePage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EquipmentCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('category')?->id;

        return [
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:160', 'alpha_dash', Rule::unique('equipment_categories', 'slug')->ignore($id)],
            'short_description' => ['nullable', 'string', 'max:255'],
            // required only when creating and no image exists yet
            'image' => [$this->isMethod('POST') ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'media_shape' => ['required', Rule::in(['sq', 'wide', 'xwide'])],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'اسم التصنيف',
            'slug' => 'المعرّف (slug)',
            'short_description' => 'الوصف المختصر',
            'image' => 'الصورة',
            'image_alt' => 'النص البديل للصورة',
            'media_shape' => 'شكل الصورة',
            'sort_order' => 'الترتيب',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم التصنيف مطلوب.',
            'slug.unique' => 'هذا المعرّف مستخدم بالفعل لتصنيف آخر.',
            'slug.alpha_dash' => 'المعرّف يجب أن يحتوي على حروف إنجليزية وأرقام وشرطات فقط.',
            'image.required' => 'صورة التصنيف مطلوبة عند الإضافة.',
            'image.image' => 'الملف المرفوع يجب أن يكون صورة صالحة.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 4 ميجابايت.',
            'media_shape.required' => 'اختر شكل الصورة المناسب.',
        ];
    }
}
