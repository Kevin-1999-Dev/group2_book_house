<?php

namespace App\Contracts\Dao;

interface PublicDaoInterface
{
    public function getBooks(): object;
}