<?php

namespace App\Repositories\Eloquent;

use App\Models\Counter\Counter;
use App\Repositories\Interfaces\CounterRepositoryInterface;

class CounterRepository extends BaseRepository implements CounterRepositoryInterface
{
    public function __construct(Counter $model)
    {
        parent::__construct($model);
    }
}
