<?php

namespace App\Http\Requests\Dashboard\HomePage;

use App\Models\HomePage\HomeSectionItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HomeSectionItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $section = $this->route('section');
        // the item type is derived from the section, never trusted from input
        $expected = $section?->itemType();

        return [
            'type' => ['required', Rule::in($expected ? [$expected] : HomeSectionItem::TYPES)],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'label' => ['nullable', 'string', 'max:30'],
            'icon_key' => ['nullable', Rule::in(HomeSectionItem::ICON_KEYS)],
            'settings' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
            'is_final' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'العنوان',
            'description' => 'الوصف',
            'label' => 'الرقم أو التسمية',
            'icon_key' => 'الأيقونة',
            'sort_order' => 'الترتيب',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'العنوان مطلوب.',
            'title.max' => 'العنوان طويل جدًا (الحد الأقصى 255 حرفًا).',
            'description.max' => 'النص طويل جدًا (الحد الأقصى 2000 حرف).',
            'icon_key.in' => 'الأيقونة المختارة غير متاحة في الصفحة.',
            'type.in' => 'نوع العنصر لا يطابق القسم المحدد.',
        ];
    }
}
