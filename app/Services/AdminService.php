<?php

namespace App\Services;

use App\Contracts\Dao\AdminDaoInterface;
use App\Contracts\Services\AdminServiceInterface;
use App\Dao\AdminDao;
use App\Http\Requests\BookRequest;
use App\Http\Requests\EbookRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

class AdminService implements AdminServiceInterface
{
    private $adminDao;

    public function __construct(AdminDaoInterface $adminDao)
    {
        $this->adminDao = $adminDao;
    }
    public function password(array $data)
    {
        $this->adminDao->password($data);
    }

    public function  adminProfile(ProfileRequest $data,int $id){
        $this->adminDao->adminProfile($data,$id);
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
        $this->adminDao->updateCategory($data, $id);
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
        $this->adminDao->updateAuthor($data, $id);
    }

    public function deleteAuthorById(int $id)
    {
        $this->adminDao->deleteAuthorById($id);
    }


    public function getOrders(Request $r)
    {
        return $this->adminDao->getOrders($r);
    }

    public function getOrderById(int $id)
    {
        return $this->adminDao->getOrderById($id);
    }

    public function updateOrder(array $data, int $id)
    {
        $this->adminDao->updateOrder($data, $id);
    }

    public function getBooks(Request $r)
    {
        return $this->adminDao->getBooks($r);
    }

    public function getBookById($id)
    {
        return $this->adminDao->getBookById($id);
    }

    public function createBook(BookRequest $data)
    {
        $this->adminDao->createBook($data);
    }

    public function updateBook(array $data, int $id)
    {
        $this->adminDao->updateBook($data, $id);
    }

    public function deleteBookById(int $id)
    {
        $this->adminDao->deleteBookById($id);
    }

    public function getEbooks(Request $r)
    {
        return $this->adminDao->getEbooks($r);
    }

    public function getEbookById($id)
    {
        return $this->adminDao->getEbookById($id);
    }

    public function createEbook(EbookRequest $data)
    {
        $this->adminDao->createEbook($data);
    }

    public function updateEbook(array $data, int $id)
    {
        $this->adminDao->updateEbook($data, $id);
    }

    public function deleteEbookById(int $id)
    {
        $this->adminDao->deleteEbookById($id);
    }

    public function getUsers(Request $r)
    {
        return $this->adminDao->getUsers($r);
    }

    public function getUserById($id)
    {
        return $this->adminDao->getUserById($id);
    }

    public function updateUser(array $data, int $id)
    {
        $this->adminDao->updateUser($data, $id);
    }

    public function deleteUser(int $id)
    {
        $this->adminDao->deleteUser($id);
    }

    public function getFeedback(Request $r)
    {
        return $this->adminDao->getFeedback($r);
    }

    public function getFeedbackById($id)
    {
        return $this->adminDao->getFeedbackById($id);
    }

    public function deleteFeedback(int $id)
    {
        $this->adminDao->deleteFeedback($id);
    }
}
