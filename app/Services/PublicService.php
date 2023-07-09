<?php

namespace App\Services;

use App\Contracts\Dao\PublicDaoInterface;
use App\Contracts\Services\PublicServiceInterface;

class PublicService implements PublicServiceInterface
{
    private $publicDao;

    public function __construct(PublicDaoInterface $publicDao)
    {
        $this->publicDao = $publicDao;
    }

    public function getBooks(): object
    {
        return $this->publicDao->getBooks();
    }
}
