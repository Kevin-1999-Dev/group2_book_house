<?php

namespace App\Contracts\Dao;

use App\Http\Requests\BookRequest;
use App\Http\Requests\EbookRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

/**
 * Interface of Data Access Object for user
 */
interface AdminDaoInterface
{


    public function adminProfile(ProfileRequest $data,int $id);

    public function getCategories(Request $r);

    public function createCategory(array $data);

    public function getCategoryById(int $id);

    public function updateCategory(array $data, int $id);

    public function deleteCategoryById(int $id);

    public function getAuthors(Request $r);

    public function createAuthor(array $data);

    public function getAuthorById(int $id);

    public function updateAuthor(array $data, int $id);

    public function deleteAuthorById(int $id);

    public function getPayments(Request $r);

    public function createPayment(array $data);

    public function getPaymentById(int $id);

    public function updatePayment(array $data, int $id);

    public function deletePaymentById(int $id);

    public function getOrders(Request $r);

    public function getOrderById(int $id);

    public function updateOrder(array $data, int $id);

    public function getBooks(Request $r);

    public function getBookById($id);

    public function createBook(BookRequest $data);

    public function updateBook(BookRequest $data, int $id);

    public function deleteBookById(int $id);

    public function getEbooks(Request $r);

    public function getEbookById($id);

    public function createEbook(EbookRequest $data);

    public function updateEbook(EbookRequest $data, int $id);

    public function deleteEbookById(int $id);

    public function getUsers(Request $r);

    public function getUserById($id);

    public function updateUser(array $data, int $id);

    public function deleteUser(int $id);

    public function getFeedback(Request $r);

    public function getFeedbackById($id);

    public function deleteFeedback(int $id);
}
