<?php

namespace App\Contracts\Services;

/**
 * Interface for user service
 */
interface PublicServiceInterface
{
  public function getAll(): object;

  public function getBooks(): object;

  public function getEbooks(): object;

}
