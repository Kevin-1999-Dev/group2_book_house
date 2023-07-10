<?php

namespace App\Contracts\Dao;

interface PublicDaoInterface
{    

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

}