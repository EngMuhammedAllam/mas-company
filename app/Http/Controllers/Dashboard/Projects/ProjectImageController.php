<?php

namespace App\Http\Controllers\Dashboard\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Project\StoreProjectImageRequest;
use App\Http\Requests\Dashboard\Project\UpdateProjectImageRequest;
use App\Models\Projects\ProjectCategory;
use App\Services\Dashboard\Project\ProjectImageService;

class ProjectImageController extends Controller
{
    protected $imageService;

    public function __construct(ProjectImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function create($id)
    {
        $category = ProjectCategory::findOrFail($id);
        return view('dashboard.projects.image-create', compact('category'));
    }

    public function store(StoreProjectImageRequest $request)
    {
        $this->imageService->createImage($request->validated(), $request->file('image'));

        return redirect()->route('projects.index')->with('success', 'تم إضافة الصورة بنجاح.');
    }

    public function edit($id)
    {
        $image = $this->imageService->getImageById($id);
        return view('dashboard.projects.image-edit', compact('image'));
    }

    public function update(UpdateProjectImageRequest $request, $id)
    {
        $image = $this->imageService->getImageById($id);

        $this->imageService->updateImage(
            $image,
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('projects.index')->with('success', 'تم تحديث الصورة بنجاح.');
    }

    public function destroy($id)
    {
        $image = $this->imageService->getImageById($id);
        $this->imageService->deleteImage($image);

        return redirect()->route('projects.index')->with('success', 'تم حذف الصورة بنجاح.');
    }
}
