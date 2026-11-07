<?php

namespace App\Http\Requests\Dashboard\Feature;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:10|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,ico,bmp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'الاسم مطلوب',
            'title.min' => 'الاسم يجب ان يكون على الاقل 3 حروف',
            'title.max' => 'الاسم يجب ان يكون على الاكثر 100 حرف',
            'description.required' => 'الوصف مطلوب',
            'description.min' => 'الوصف يجب ان يكون على الاقل 10 حروف',
            'description.max' => 'الوصف يجب ان يكون على الاكثر 1000 حرف',
            'image.image' => 'الصورة يجب ان تكون صورة',
            'image.mimes' => 'الصورة يجب ان تكون من نوع jpeg,png,jpg,gif,svg,webp,ico,bmp',
            'image.max' => 'الصورة يجب ان تكون على الاكثر 2 ميغابايت',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'الاسم',
            'description' => 'الوصف',
            'image' => 'الصورة',
        ];
    }
}
