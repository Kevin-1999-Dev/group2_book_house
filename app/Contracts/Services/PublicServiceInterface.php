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

  public function getBookById(int $id): object;

  public function getEbookById(int $id): object;

  public function createFeedback(array $data): void;

}
