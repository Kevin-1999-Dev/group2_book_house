<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for user
 */
interface AdminDaoInterface
{
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
}
