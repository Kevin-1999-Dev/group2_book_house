<?php

namespace App\Dao;

use App\Contracts\Dao\AdminDaoInterface;
use App\Models\Category;
use App\Models\Author;

class AdminDao implements AdminDaoInterface
{
    public function getCategories()
    {
        return Category::all();
    }

    public function createCategory(array $data)
    {
        Category::create([
            'name' => $data['name'],
        ]);
    }

    public function getCategoryById(int $id)
    {
        return Category::findOrFail($id);
    }
    public function updateCategory(array $data, int $id)
    {
        Category::findOrFail($id)->update([
            'name' => $data['name'],
        ]);
    }

    public function deleteCategoryById(int $id)
    {
        Category::findOrFail($id)->delete();
    }

    public function getAuthors()
    {
        return Author::all();
    }

    public function createAuthor(array $data)
    {
        Author::create([
            'name' => $data['name'],
        ]);
    }

    public function getAuthorById(int $id)
    {
        return Author::findOrFail($id);
    }

    public function updateAuthor(array $data, int $id)
    {
        Author::findOrFail($id)->update([
            'name' => $data['name'],
        ]);
    }

    public function deleteAuthorById(int $id)
    {
        Author::findOrFail($id)->delete();
    }
}
