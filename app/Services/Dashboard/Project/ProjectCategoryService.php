<?php

namespace App\Services\Dashboard\Project;

use App\Models\Projects\ProjectCategory;

class ProjectCategoryService
{
    public function getAllCategories()
    {
        return ProjectCategory::all();
    }

    public function createCategory(array $data): ProjectCategory
    {
        return ProjectCategory::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'is_active' => isset($data['is_active']) && $data['is_active'] === 'on', // Logic preservation: 'on' -> 1/0
        ]);
    }

    public function updateCategory(ProjectCategory $category, array $data): bool
    {
        return $category->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'is_active' => isset($data['is_active']) && $data['is_active'] === 'on',
        ]);
    }

    public function deleteCategory(ProjectCategory $category): ?bool
    {
        return $category->delete();
    }

    public function getCategoryById($id)
    {
        return ProjectCategory::findOrFail($id);
    }
}
