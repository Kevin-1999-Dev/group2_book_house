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

    public function getAll(): object
    {
        return $this->publicDao->getAll();
    }

    public function getBooks(): object
    {
        return $this->publicDao->getBooks();
    }

    public function getEbooks(): object
    {
        return $this->publicDao->getEbooks();
    }
}
