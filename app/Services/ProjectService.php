<?php

namespace App\Services;

use App\Repositories\Interfaces\ProjectCategoryRepositoryInterface;
use App\Repositories\Interfaces\ProjectSectionRepositoryInterface;

use App\Repositories\Interfaces\ProjectImageRepositoryInterface;
use App\Models\Projects\ProjectCategory;
use App\Models\Projects\ProjectImage;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    protected $categoryRepo;
    protected $sectionRepo;
    protected $imageRepo;

    public function __construct(
        ProjectCategoryRepositoryInterface $categoryRepo,
        ProjectSectionRepositoryInterface $sectionRepo,
        ProjectImageRepositoryInterface $imageRepo
    ) {
        $this->categoryRepo = $categoryRepo;
        $this->sectionRepo = $sectionRepo;
        $this->imageRepo = $imageRepo;
    }

    public function getProjectIndexData()
    {
        $section = $this->sectionRepo->first();
        $categories = ProjectCategory::with('images')->get();

        return compact('section', 'categories');
    }

    // Category CRUD
    public function findCategory(int $id)
    {
        return $this->categoryRepo->find($id);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepo->create($data);
    }

    public function updateCategory(int $id, array $data)
    {
        return $this->categoryRepo->update($id, $data);
    }

    public function deleteCategory(int $id)
    {
        return $this->categoryRepo->delete($id);
    }

    // Image CRUD
    public function findImage(int $id)
    {
        return $this->imageRepo->find($id);
    }

    public function createProjectImage(array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $imagePath = $data['image']->storeAs(
                'projects',
                time() . '_' . $data['image']->getClientOriginalName(),
                'public'
            );
            $data['image'] = basename($imagePath);
        }
        return $this->imageRepo->create($data);
    }

    public function updateProjectImage(int $id, array $data)
    {
        $imageInstance = $this->imageRepo->find($id);
        if (isset($data['image']) && is_object($data['image'])) {
            if ($imageInstance->image) {
                Storage::disk('public')->delete('projects/' . $imageInstance->image);
            }
            $imagePath = $data['image']->storeAs(
                'projects',
                time() . '_' . $data['image']->getClientOriginalName(),
                'public'
            );
            $data['image'] = basename($imagePath);
        }
        return $this->imageRepo->update($id, $data);
    }

    public function deleteProjectImage(int $id)
    {
        $imageInstance = $this->imageRepo->find($id);
        if ($imageInstance && $imageInstance->image) {
            Storage::disk('public')->delete('projects/' . $imageInstance->image);
        }
        return $this->imageRepo->delete($id);
    }

    // Section Update
    public function updateProjectSection(array $data)
    {
        $section = $this->sectionRepo->first();
        if (!$section) {
            return $this->sectionRepo->create($data);
        }
        return $section->update($data);
    }
}
