<?php
namespace App\Services;
use App\Contracts\Dao\PublicDaoInterface;
use App\Contracts\Services\PublicServiceInterface;
class PublicService implements PublicServiceInterface
{
    private $publicDao;
    /**
     * __construct
     *
     * @param  mixed $publicDao
     * @return void
     */
    public function __construct(PublicDaoInterface $publicDao)
    {
        $this->publicDao = $publicDao;
    }
    /**
     * getAll
     *
     * @return object
     */
    public function getAll(): object
    {
        return $this->publicDao->getAll();
    }
    /**
     * getBooks
     *
     * @return object
     */
    public function getBooks(): object
    {
        return $this->publicDao->getBooks();
    }
    /**
     * getEbooks
     *
     * @return object
     */
    public function getEbooks(): object
    {
        return $this->publicDao->getEbooks();
    }
    /**
     * getBookById
     *
     * @param  mixed $id
     * @return object
     */
    public function getBookById(int $id): object
    {
        return $this->publicDao->getBookById($id);
    }
    /**
     * getEbookById
     *
     * @param  mixed $id
     * @return object
     */
    public function getEbookById(int $id): object
    {
        return $this->publicDao->getEbookById($id);
    }
    /**
     * createFeedback
     *
     * @param  mixed $data
     * @return void
     */
    public function createFeedback(array $data): void
    {
        $this->publicDao->createFeedback($data);
    }
}
