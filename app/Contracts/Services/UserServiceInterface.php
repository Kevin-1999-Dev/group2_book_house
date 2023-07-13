<?php

namespace App\Contracts\Services;

use App\Http\Requests\ProfileRequest;

interface UserServiceInterface
{
    public function password(array $data);

    public function userProfile(ProfileRequest $data, int $id);
}
