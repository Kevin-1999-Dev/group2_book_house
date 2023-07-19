<?php

namespace App\Contracts\Dao;

use App\Http\Requests\ProfileRequest;

Interface UserDaoInterface
{
    public function password(array $data);
    public function userProfile(ProfileRequest $data, int $id);
    public function deleteAcc(int $id);
}
