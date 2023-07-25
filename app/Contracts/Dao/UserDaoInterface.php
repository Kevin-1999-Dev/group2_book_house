<?php

namespace App\Contracts\Dao;

use App\Http\Requests\ProfileRequest;

interface UserDaoInterface
{    
    /**
     * userProfile
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function userProfile(ProfileRequest $data, int $id);
        
    /**
     * deleteAcc
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteAcc(int $id);
}
