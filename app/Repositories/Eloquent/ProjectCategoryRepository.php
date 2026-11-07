<?php

namespace App\Repositories\Eloquent;

use App\Models\Projects\ProjectCategory;
use App\Repositories\Interfaces\ProjectCategoryRepositoryInterface;

class ProjectCategoryRepository extends BaseRepository implements ProjectCategoryRepositoryInterface
{
    public function __construct(ProjectCategory $model)
    {
        parent::__construct($model);
    }
}
