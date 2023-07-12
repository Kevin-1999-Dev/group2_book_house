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

    public function getBookById(int $id): object
    {
        return $this->publicDao->getBookById($id);
    }

    public function getEbookById(int $id): object
    {
        return $this->publicDao->getEbookById($id);
    }
}
