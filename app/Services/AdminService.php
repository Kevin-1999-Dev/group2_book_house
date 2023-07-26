<?php

namespace App\Services;

use App\Contracts\Dao\AdminDaoInterface;
use App\Contracts\Services\AdminServiceInterface;
use App\Http\Requests\BookRequest;
use App\Http\Requests\EbookRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

/**
 * AdminService
 */
class AdminService implements AdminServiceInterface
{
    private $adminDao;

    /**
     * __construct
     *
     * @param  mixed $adminDao
     * @return void
     */
    public function __construct(AdminDaoInterface $adminDao)
    {
        $this->adminDao = $adminDao;
    }

    /**
     * adminProfile
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function  adminProfile(ProfileRequest $data, int $id)
    {
        $this->adminDao->adminProfile($data, $id);
    }

    /**
     * getCategories
     *
     * @param  mixed $r
     * @return void
     */
    public function getCategories(Request $r)
    {
        return $this->adminDao->getCategories($r);
    }

    /**
     * createCategory
     *
     * @param  mixed $data
     * @return void
     */
    public function createCategory(array $data)
    {
        $this->adminDao->createCategory($data);
    }

    /**
     * getCategoryById
     *
     * @param  mixed $id
     * @return void
     */
    public function getCategoryById(int $id)
    {
        return $this->adminDao->getCategoryById($id);
    }

    /**
     * updateCategory
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateCategory(array $data, int $id)
    {
        $this->adminDao->updateCategory($data, $id);
    }

    /**
     * deleteCategoryById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteCategoryById(int $id)
    {
        $this->adminDao->deleteCategoryById($id);
    }

    /**
     * getAuthors
     *
     * @param  mixed $r
     * @return void
     */
    public function getAuthors(Request $r)
    {
        return $this->adminDao->getAuthors($r);
    }

    /**
     * createAuthor
     *
     * @param  mixed $data
     * @return void
     */
    public function createAuthor(array $data)
    {
        $this->adminDao->createAuthor($data);
    }

    /**
     * getAuthorById
     *
     * @param  mixed $id
     * @return void
     */
    public function getAuthorById(int $id)
    {
        return $this->adminDao->getAuthorById($id);
    }

    /**
     * updateAuthor
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateAuthor(array $data, int $id)
    {
        $this->adminDao->updateAuthor($data, $id);
    }

    /**
     * deleteAuthorById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteAuthorById(int $id)
    {
        $this->adminDao->deleteAuthorById($id);
    }

    /**
     * getPayments
     *
     * @param  mixed $r
     * @return void
     */
    public function getPayments(Request $r)
    {
        return $this->adminDao->getPayments($r);
    }

    /**
     * createPayment
     *
     * @param  mixed $data
     * @return void
     */
    public function createPayment(array $data)
    {
        $this->adminDao->createPayment($data);
    }

    /**
     * getPaymentById
     *
     * @param  mixed $id
     * @return void
     */
    public function getPaymentById(int $id)
    {
        return $this->adminDao->getPaymentById($id);
    }

    /**
     * updatePayment
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updatePayment(array $data, int $id)
    {
        $this->adminDao->updatePayment($data, $id);
    }

    /**
     * deletePaymentById
     *
     * @param  mixed $id
     * @return void
     */
    public function deletePaymentById(int $id)
    {
        $this->adminDao->deletePaymentById($id);
    }

    /**
     * getOrders
     *
     * @param  mixed $r
     * @return void
     */
    public function getOrders(Request $r)
    {
        return $this->adminDao->getOrders($r);
    }

    /**
     * getOrderById
     *
     * @param  mixed $id
     * @return void
     */
    public function getOrderById(int $id)
    {
        return $this->adminDao->getOrderById($id);
    }

    /**
     * updateOrder
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateOrder(array $data, int $id)
    {
        $this->adminDao->updateOrder($data, $id);
    }

    /**
     * getBooks
     *
     * @param  mixed $r
     * @return void
     */
    public function getBooks(Request $r)
    {
        return $this->adminDao->getBooks($r);
    }

    /**
     * getBookById
     *
     * @param  mixed $id
     * @return void
     */
    public function getBookById($id)
    {
        return $this->adminDao->getBookById($id);
    }

    /**
     * createBook
     *
     * @param  mixed $data
     * @return void
     */
    public function createBook(BookRequest $data)
    {
        $this->adminDao->createBook($data);
    }

    /**
     * updateBook
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateBook(BookRequest $data, int $id)
    {
        $this->adminDao->updateBook($data, $id);
    }

    /**
     * deleteBookById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteBookById(int $id)
    {
        $this->adminDao->deleteBookById($id);
    }

    /**
     * getEbooks
     *
     * @param  mixed $r
     * @return void
     */
    public function getEbooks(Request $r)
    {
        return $this->adminDao->getEbooks($r);
    }

    /**
     * getEbookById
     *
     * @param  mixed $id
     * @return void
     */
    public function getEbookById($id)
    {
        return $this->adminDao->getEbookById($id);
    }

    /**
     * createEbook
     *
     * @param  mixed $data
     * @return void
     */
    public function createEbook(EbookRequest $data)
    {
        $this->adminDao->createEbook($data);
    }

    /**
     * updateEbook
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateEbook(EbookRequest $data, int $id)
    {
        $this->adminDao->updateEbook($data, $id);
    }

    /**
     * deleteEbookById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteEbookById(int $id)
    {
        $this->adminDao->deleteEbookById($id);
    }

    /**
     * getUsers
     *
     * @param  mixed $r
     * @return void
     */
    public function getUsers(Request $r)
    {
        return $this->adminDao->getUsers($r);
    }

    /**
     * getUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function getUserById($id)
    {
        return $this->adminDao->getUserById($id);
    }

    /**
     * updateUser
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateUser(array $data, int $id)
    {
        $this->adminDao->updateUser($data, $id);
    }

    /**
     * deleteUser
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        $this->adminDao->deleteUser($id);
    }

    /**
     * getFeedback
     *
     * @param  mixed $r
     * @return void
     */
    public function getFeedback(Request $r)
    {
        return $this->adminDao->getFeedback($r);
    }

    /**
     * getFeedbackById
     *
     * @param  mixed $id
     * @return void
     */
    public function getFeedbackById($id)
    {
        return $this->adminDao->getFeedbackById($id);
    }

    /**
     * deleteFeedback
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteFeedback(int $id)
    {
        $this->adminDao->deleteFeedback($id);
    }
}
