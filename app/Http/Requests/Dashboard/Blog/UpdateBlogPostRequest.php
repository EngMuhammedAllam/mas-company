<?php

namespace App\Http\Requests\Dashboard\Blog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
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
            'title' => 'required',
            'excerpt' => 'nullable',
            'content' => 'required',
            'author' => 'nullable',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'is_active' => 'boolean',
        ];
    }
}
