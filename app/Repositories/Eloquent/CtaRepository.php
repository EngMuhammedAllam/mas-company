<?php

namespace App\Repositories\Eloquent;

use App\Models\Cta\CtaSection;
use App\Repositories\Interfaces\CtaRepositoryInterface;

class CtaRepository extends BaseRepository implements CtaRepositoryInterface
{
    public function __construct(CtaSection $model)
    {
        parent::__construct($model);
    }
}
