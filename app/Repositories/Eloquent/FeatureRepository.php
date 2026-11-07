<?php

namespace App\Repositories\Eloquent;

use App\Models\Feature\Feature;
use App\Repositories\Interfaces\FeatureRepositoryInterface;

class FeatureRepository extends BaseRepository implements FeatureRepositoryInterface
{
    public function __construct(Feature $model)
    {
        parent::__construct($model);
    }
}
