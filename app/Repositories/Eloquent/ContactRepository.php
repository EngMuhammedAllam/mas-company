<?php

namespace App\Repositories\Eloquent;

use App\Models\Contact\Contact;
use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }

    public function getLatestPaginated(int $perPage = 10)
    {
        return $this->model->latest()->paginate($perPage);
    }
}
