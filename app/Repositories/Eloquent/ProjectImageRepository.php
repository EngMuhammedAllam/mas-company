<?php

namespace App\Repositories\Eloquent;

use App\Models\Projects\ProjectImage;
use App\Repositories\Interfaces\ProjectImageRepositoryInterface;

class ProjectImageRepository extends BaseRepository implements ProjectImageRepositoryInterface
{
    public function __construct(ProjectImage $model)
    {
        parent::__construct($model);
    }
}
