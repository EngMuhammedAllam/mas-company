<?php

namespace App\Repositories\Eloquent;

use App\Models\Projects\ProjectSection;
use App\Repositories\Interfaces\ProjectSectionRepositoryInterface;

class ProjectSectionRepository extends BaseRepository implements ProjectSectionRepositoryInterface
{
    public function __construct(ProjectSection $model)
    {
        parent::__construct($model);
    }
}
