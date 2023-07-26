<?php

namespace App\Contracts\Services;

use App\Http\Requests\BookRequest;
use App\Http\Requests\EbookRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

/**
 * Interface for user service
 */
interface AdminServiceInterface
{
    /**
     * adminProfile
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function adminProfile(ProfileRequest $data, int $id);

    /**
     * getCategories
     *
     * @param  mixed $r
     * @return void
     */
    public function getCategories(Request $r);

    /**
     * createCategory
     *
     * @param  mixed $data
     * @return void
     */
    public function createCategory(array $data);

    /**
     * getCategoryById
     *
     * @param  mixed $id
     * @return void
     */
    public function getCategoryById(int $id);

    /**
     * updateCategory
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateCategory(array $data, int $id);

    /**
     * deleteCategoryById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteCategoryById(int $id);

    /**
     * getAuthors
     *
     * @param  mixed $r
     * @return void
     */
    public function getAuthors(Request $r);

    /**
     * createAuthor
     *
     * @param  mixed $data
     * @return void
     */
    public function createAuthor(array $data);

    /**
     * getAuthorById
     *
     * @param  mixed $id
     * @return void
     */
    public function getAuthorById(int $id);

    /**
     * updateAuthor
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateAuthor(array $data, int $id);

    /**
     * deleteAuthorById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteAuthorById(int $id);

    /**
     * getPayments
     *
     * @param  mixed $r
     * @return void
     */
    public function getPayments(Request $r);

    /**
     * createPayment
     *
     * @param  mixed $data
     * @return void
     */
    public function createPayment(array $data);

    /**
     * getPaymentById
     *
     * @param  mixed $id
     * @return void
     */
    public function getPaymentById(int $id);

    /**
     * updatePayment
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updatePayment(array $data, int $id);

    /**
     * deletePaymentById
     *
     * @param  mixed $id
     * @return void
     */
    public function deletePaymentById(int $id);

    /**
     * getOrders
     *
     * @param  mixed $r
     * @return void
     */
    public function getOrders(Request $r);

    /**
     * getOrderById
     *
     * @param  mixed $id
     * @return void
     */
    public function getOrderById(int $id);

    /**
     * updateOrder
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateOrder(array $data, int $id);

    /**
     * getBooks
     *
     * @param  mixed $r
     * @return void
     */
    public function getBooks(Request $r);

    /**
     * getBookById
     *
     * @param  mixed $id
     * @return void
     */
    public function getBookById($id);

    /**
     * createBook
     *
     * @param  mixed $data
     * @return void
     */
    public function createBook(BookRequest $data);

    /**
     * updateBook
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateBook(BookRequest $data, int $id);

    /**
     * deleteBookById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteBookById(int $id);

    /**
     * getEbooks
     *
     * @param  mixed $r
     * @return void
     */
    public function getEbooks(Request $r);

    /**
     * getEbookById
     *
     * @param  mixed $id
     * @return void
     */
    public function getEbookById($id);

    /**
     * createEbook
     *
     * @param  mixed $data
     * @return void
     */
    public function createEbook(EbookRequest $data);

    /**
     * updateEbook
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateEbook(EbookRequest $data, int $id);

    /**
     * deleteEbookById
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteEbookById(int $id);

    public function getUsers(Request $r);

    /**
     * getUserById
     *
     * @param  mixed $id
     * @return void
     */
    public function getUserById($id);

    /**
     * updateUser
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function updateUser(array $data, int $id);

    /**
     * deleteUser
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteUser(int $id);

    /**
     * getFeedback
     *
     * @param  mixed $r
     * @return void
     */
    public function getFeedback(Request $r);

    /**
     * getFeedbackById
     *
     * @param  mixed $id
     * @return void
     */
    public function getFeedbackById($id);

    /**
     * deleteFeedback
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteFeedback(int $id);
}
