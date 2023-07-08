<?php

namespace App\Services;

use App\Contracts\Dao\AdminDaoInterface;
use App\Contracts\Services\AdminServiceInterface;

class AdminService implements AdminServiceInterface
{
    private $adminDao;

    public function __construct(AdminDaoInterface $adminDao)
    {
        $this->adminDao = $adminDao;
    }

    public function getCategories()
    {
        return $this->adminDao->getCategories();
    }

    public function createCategory(array $data)
    {
        $this->adminDao->createCategory($data);
    }

    public function getCategoryById(int $id)
    {
        return $this->adminDao->getCategoryById($id);
    }
    public function updateCategory(array $data, int $id)
    {
        $this->adminDao->updateCategory($data,$id);
    }

    public function deleteCategoryById(int $id)
    {
        $this->adminDao->deleteCategoryById($id);
    }

    public function getAuthors()
    {
        return $this->adminDao->getAuthors();
    }

    public function createAuthor(array $data)
    {
        $this->adminDao->createAuthor($data);
    }

    public function getAuthorById(int $id)
    {
        return $this->adminDao->getAuthorById($id);
    }

    public function updateAuthor(array $data, int $id)
    {
        $this->adminDao->updateAuthor($data,$id);
    }

    public function deleteAuthorById(int $id)
    {
        $this->adminDao->deleteAuthorById($id);
    }
}
