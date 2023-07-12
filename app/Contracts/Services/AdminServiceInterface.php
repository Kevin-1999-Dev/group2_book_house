<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

/**
 * Interface for user service
 */
interface AdminServiceInterface
{
    public function password(array $data);
    public function getCategories();

    public function createCategory(array $data);

    public function getCategoryById(int $id);

    public function updateCategory(array $data, int $id);

    public function deleteCategoryById(int $id);

    public function getAuthors();

    public function createAuthor(array $data);

    public function getAuthorById(int $id);

    public function updateAuthor(array $data, int $id);

    public function deleteAuthorById(int $id);

    public function getOrders(Request $r);

    public function getOrderById(int $id);

    public function acceptOrderById(int $id);

    public function declineOrderById(int $id);
}
