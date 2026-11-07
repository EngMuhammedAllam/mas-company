<?php

namespace App\Repositories\Eloquent;

use App\Models\About\AboutSection;
use App\Repositories\Interfaces\AboutRepositoryInterface;

class AboutRepository extends BaseRepository implements AboutRepositoryInterface
{
    public function __construct(AboutSection $model)
    {
        parent::__construct($model);
    }

    public function getWithPoints()
    {
        return $this->model->with('points')->first();
    }
}
