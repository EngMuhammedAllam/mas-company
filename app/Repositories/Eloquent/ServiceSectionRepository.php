<?php

namespace App\Repositories\Eloquent;

use App\Models\Service\ServiceSection;
use App\Repositories\Interfaces\ServiceSectionRepositoryInterface;

class ServiceSectionRepository extends BaseRepository implements ServiceSectionRepositoryInterface
{
    public function __construct(ServiceSection $model)
    {
        parent::__construct($model);
    }

    public function getActive()
    {
        return $this->model->active();
    }
}
