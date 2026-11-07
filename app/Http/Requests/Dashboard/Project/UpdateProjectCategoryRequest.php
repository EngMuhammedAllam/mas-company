<?php

namespace App\Http\Requests\Dashboard\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectCategoryRequest extends FormRequest
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
        // Note: The controller used $request->category_id for the unique ignore.
        // I will assume category_id is passed in the request or route.
        // Using $this->id or $this->route('id') might be safer if it's a route parameter.
        // The original code used $request->category_id in the unique rule string concatenation.

        return [
            'name' => 'required|string',
            'slug' => 'required|string|unique:project_categories,slug,' . $this->category_id,
            'is_active' => 'nullable|in:on',
            'category_id' => 'required|exists:project_categories,id', // Ensuring it exists since it's used
        ];
    }
}
