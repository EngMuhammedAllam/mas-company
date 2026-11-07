<?php

namespace App\Http\Requests\Dashboard\HomePage;

use App\Models\HomePage\EquipmentProduct;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EquipmentProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('product')?->id;

        return [
            'equipment_category_id' => ['required', 'integer', 'exists:equipment_categories,id'],
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', 'alpha_dash', Rule::unique('equipment_products', 'slug')->ignore($id)],
            'kicker' => ['nullable', 'string', 'max:160'],
            'description' => ['required', 'string', 'max:1000'],
            // on edit the existing approved image is kept when no file is sent
            'image' => [$this->isMethod('POST') ? 'required' : 'nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'media_shape' => ['required', Rule::in(EquipmentProduct::SHAPES)],
            'availability_label' => ['nullable', 'string', 'max:120'],
            'is_available' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'specifications' => ['nullable', 'array'],
            'specifications.*.label' => ['nullable', 'string', 'max:120'],
            'specifications.*.value' => ['nullable', 'string', 'max:255'],
            'whatsapp_price_message' => ['nullable', 'string', 'max:1000'],
            'whatsapp_details_message' => ['nullable', 'string', 'max:1000'],
            'whatsapp_specs_message' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }

    public function attributes(): array
    {
        return [
            'equipment_category_id' => 'التصنيف',
            'name' => 'اسم المعدة',
            'slug' => 'المعرّف (slug)',
            'kicker' => 'التصنيف الفرعي',
            'description' => 'الوصف',
            'image' => 'صورة المعدة',
            'image_alt' => 'النص البديل للصورة',
            'media_shape' => 'شكل الصورة',
            'availability_label' => 'نص حالة التوافر',
            'whatsapp_price_message' => 'رسالة السعر',
            'whatsapp_details_message' => 'رسالة التفاصيل',
            'whatsapp_specs_message' => 'رسالة المواصفات',
            'sort_order' => 'الترتيب',
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
            'slug.unique' => 'هذا المعرّف مستخدم بالفعل لمعدة أخرى.',
            'image.required' => 'صورة المعدة مطلوبة عند الإضافة.',
            'image.image' => 'الملف المرفوع يجب أن يكون صورة صالحة.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 4 ميجابايت.',
            'media_shape.required' => 'اختر شكل الصورة المناسب.',
        ];
    }
}
