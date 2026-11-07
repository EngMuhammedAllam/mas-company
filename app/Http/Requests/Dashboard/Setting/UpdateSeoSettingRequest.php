<?php

namespace App\Http\Requests\Dashboard\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeoSettingRequest extends FormRequest
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
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'robots' => 'nullable|string|max:50',
            'author' => 'nullable|string|max:255',
            'twitter_handle' => 'nullable|string|max:255',
            'twitter_card_type' => 'nullable|string|max:50',
            'og_type' => 'nullable|string|max:50',
            'og_site_name' => 'nullable|string|max:255',
            'header_code' => 'nullable|string',
            'footer_code' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:1024',
        ];
    }
}
