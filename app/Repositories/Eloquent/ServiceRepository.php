<?php

namespace App\Repositories\Eloquent;

use App\Models\Service\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }
}
