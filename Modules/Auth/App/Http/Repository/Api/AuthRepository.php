<?php

namespace Modules\Auth\App\Http\Repository\Api;

use Modules\Auth\Models\User;
use Modules\Auth\App\Http\Interface\Api\AuthInterface;

class AuthRepository implements AuthInterface
{
    public function find($request)
    {
        return User::where('email', $request->email)->first();
    }
}
