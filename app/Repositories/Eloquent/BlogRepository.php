<?php

namespace App\Repositories\Eloquent;

use App\Models\Blog\BlogPost;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(BlogPost $model)
    {
        parent::__construct($model);
    }
}
