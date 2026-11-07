<?php

namespace App\Http\Controllers\Dashboard\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Project\StoreProjectCategoryRequest;
use App\Http\Requests\Dashboard\Project\UpdateProjectCategoryRequest;
use App\Services\Dashboard\Project\ProjectCategoryService;

class ProjectCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(ProjectCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create()
    {
        return view('dashboard.projects.category-create');
    }

    public function store(StoreProjectCategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());

        return redirect()->route('projects.index')->with('success', 'تم إضافة التصنيف بنجاح.');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('dashboard.projects.category-edit', compact('category'));
    }

    public function update(UpdateProjectCategoryRequest $request, $id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $this->categoryService->updateCategory($category, $request->validated());

        return redirect()->route('projects.index')->with('success', 'تم تحديث التصنيف بنجاح.');
    }

    public function destroy($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $this->categoryService->deleteCategory($category);

        return redirect()->route('projects.index')->with('success', 'تم حذف التصنيف بنجاح.');
    }
}
