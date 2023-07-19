<?php

namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\ProfileRequest;

class UserService implements UserServiceInterface
{
    private $userDao;

    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    public function password(array $data)
    {
        $this->userDao->password($data);
    }
    public function userProfile(ProfileRequest $data, int $id )
    {
        $this->userDao->userProfile($data, $id);
    }
    public function deleteAcc(int $id)
    {
        $this->userDao->deleteAcc($id);
    }
}
