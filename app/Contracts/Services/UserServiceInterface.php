<?php

namespace App\Contracts\Services;

use App\Http\Requests\ProfileRequest;

interface UserServiceInterface
{
    public function userProfile(ProfileRequest $data, int $id);
    public function deleteAcc(int $id);
}
