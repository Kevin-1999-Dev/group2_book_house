<?php
namespace App\Contracts\Dao;
interface PublicDaoInterface
{
    /**
     * getAll
     *
     * @return object
     */
    public function getAll(): object;
    /**
     * getBooks
     *
     * @return object
     */
    public function getBooks(): object;
    /**
     * getEbooks
     *
     * @return object
     */
    public function getEbooks(): object;
    /**
     * getBookById
     *
     * @param  mixed $id
     * @return object
     */
    public function getBookById(int $id): object;
    /**
     * getEbookById
     *
     * @param  mixed $id
     * @return object
     */
    public function getEbookById(int $id): object;
    /**
     * createFeedback
     *
     * @param  mixed $data
     * @return void
     */
    public function createFeedback(array $data): void;
}
