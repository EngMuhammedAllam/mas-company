<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting\ContactSetting;
use App\Repositories\Interfaces\ContactSettingRepositoryInterface;

class ContactSettingRepository extends BaseRepository implements ContactSettingRepositoryInterface
{
    public function __construct(ContactSetting $model)
    {
        parent::__construct($model);
    }
}
